<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Add to the shopping cart
     *	param Request input
     * @returns to request page
     */
	public function addToShoppingCart(Request $request) {
		if(session()->get('userOrderList') === null | session()->get('userOrderList') === 0) {
			$array[0]['tsPics'] = $request->tshirtPics;
			$array[0]['color'] = $request->tshirtColor;
			$array[0]['size'] = $request->tshirtSize;
			$array[0]['prize'] = $request->prize;
			$array[0]['number'] = '1';
			
			session()->put('userOrderList', $array);
			session()->put('userOrderPrizeSum', $request->prize);
		} else {
			$userOrderListArray = session()->get('userOrderList');
			$array1['tsPics'] = $request->tshirtPics;
			$array1['color'] = $request->tshirtColor;
			$array1['size'] = $request->tshirtSize;
			$array1['prize'] = $request->prize;
			$array1['number'] = '1';
			array_push($userOrderListArray,$array1);
			session()->put('userOrderList', $userOrderListArray);
			session()->put('userOrderPrizeSum', (session()->get('userOrderPrizeSum') + $request->prize));
		}
		$array1 = session()->get('userOrderList');
		unset($array1);

		return back();	
	}
	
	/**
     * Show customers shopping cart
     *	
     * @returns shoppingCart.blade.php
     */
	public function showShoppingCart() {
		return view('shoppingCart');
	}
	
	/**
     * Delete item from the shopping cart
     *	
     * @returns to request page
     */
	 public function deleteOrderListItem() {
		$olArray = session()->get('userOrderList');
		$index = $_GET['index'];
		session()->put('userOrderPrizeSum', session()->get('userOrderPrizeSum') - $olArray[$index][0]);
		unset($olArray[$index]);
		session()->put('userOrderList', $olArray);		
		return back();
	}
	
	/**
     * Send the order, and shows items of the shopping cart
     *	
     * 
     */
	public function setOrder(Request $request) {
		$max = intval($request->orderItemNumberIndex);
		$array = session()->get('userOrderList');
		for($i = 0; $i < $max; $i++) {
			$currentNumber = 'userOrderItemNumber'.$i;
			$array[$i]['number'] = $request->$currentNumber;		
		}
		session()->put('userOrderList', $array);
		
		return view('orderForm');
	}
	
	/**
     * Insert the order to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */	 
	 public function insertOrder(Request $request) {
		$this->validate($request, $this->userDatasRules(), $this->validationErrorMessages());
		$currentDate = now();
		foreach(session()->get('userOrderList') as $item) {
			DB::table('orders')->insert(['id'=>null,'tsPics'=>$item['tsPics'],'color'=>$item['color'],'size'=>$item['size'],'prize'=>$item['prize'],
				'number'=>$item['number'],'name'=>$request->name,'address'=>$request->address,'phone'=>$request->phoneNumber,'created_at'=>$currentDate, 'updated_at'=>$currentDate]);
		}
		session()->put('userOrderList', null);
		session()->put('userOrderPrizeSum', null);
		return redirect()->route('/orderConfirmation');
	 }
	
	
	/**
     * Get the order validation rules.
     *
     * @return array
     */
    protected function userDatasRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
			'phoneNumber' => 'required|integer',
        ];
    }
	
	 /**
     * Get the order validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }
	
	/**
     * Get order confirmation message
     *
     * @return \Illuminate\Http\Response
     */
	public function showOrderConfirm() {
		return view('orderConfirm');
	}
}
