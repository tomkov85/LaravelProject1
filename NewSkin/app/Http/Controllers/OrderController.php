<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Add to the shopping cart
     *	param Request input
     * @returns to request page
     */
	public function addToShoppingCart(Request $request) {
		if(session()->get('userOrderList') == null) {
			$array = [[$request->prize,$request->tshirtColor,$request->tshirtSize,$request->tshirtPics]];
			session()->put('userOrderList', $array);
			session()->put('userOrderPrizeSum', $request->prize);
		} else {
			$userOrderListArray = session()->get('userOrderList');
			array_push($userOrderListArray,[$request->prize, $request->tshirtColor,$request->tshirtSize,$request->tshirtPics]);
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
		for($i = 0; $i < $max; $i++) {
			$currentPics = 'userOrderPics'.$i;
			$currentColor = 'userOrderColor'.$i;
			$currentSize = 'userOrderSize'.$i;
			$currentPrize = 'userOrderPrize'.$i;
			$currentNumber = 'userOrderItemNumber'.$i;
			echo $request->$currentPics.",".$request->$currentColor.",".$request->$currentSize.",".$request->$currentPrize.",".$request->$currentNumber."<br>";
		}		
	}
}
