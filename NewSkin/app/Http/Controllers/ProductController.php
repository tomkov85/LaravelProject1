<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{	
	
	 /**
     * Displays the tsPics at current id
     * param String picsId
     * @return show.blade.php
     */
	public function show($name) {
		$tshirtColor = $_GET['color'];
		$tshirtSize = $_GET['size'];
		$tshirt = DB::table('tshirts')->get()->where('color',$tshirtColor)->first();
		
		if($name == "custTs") {
			
		} else {
			$tshirtpics = DB::table('tspics')->get()->where('name',$name)->first();		
			$picsDesigner = DB::table('users')->get()->where('userId',$tshirtpics->designer)->first();
			return view('show', ['tshirtpics' => $tshirtpics, 'tshirt' => $tshirt, 'tshirtSize' => $tshirtSize, 'picsDesigner' => $picsDesigner]);			
		}
	}
	
	 /**
     * Displays the customers pics
     *
     * @return customerDesign.blade.php
     */
	
	public function customersShow() {
		if(empty($_GET['color'])) {
			$tshirtColor = "white";
			$tshirtSize = "M";
		} else {
			$tshirtColor = $_GET['color'];
			$tshirtSize = $_GET['size'];
		}
		$tshirt = DB::table('tshirts')->get()->where('color',$tshirtColor)->first();
		
		session()->put('currentTshirt', $tshirt);
		session()->put('currentTshirtSize',$tshirtSize);
		if(empty(session()->get('currentCustPics'))) {
			$currentCustPics = "";
		} else {
			$currentCustPics = session()->get('currentCustPics');
		}
		
		return view('customerDesign', ['tshirt' => $tshirt, 'tshirtSize' => $tshirtSize, 'custPicsSrc' => $currentCustPics]);
	}
	
	 /**
     * Checks and upload the customers picture
     *	param Request input
     * @returns to request page
     */
	public function checkUploadCustPics(Request $request){
		
		$this->validate($request, [
		'imageUpload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);
		
		if (!$request->hasFile('imageUpload')) {
			return back();
		}else{
			$image = $request->file('imageUpload');
			
			do {
				$tempPicsId = mt_rand(10000,99999);
				$tempPicsFileName = "custPicsId".$tempPicsId.".jpg"; 
			} while(file_exists("uploads/".$tempPicsFileName));
			
			session()->put('currentCustPics', "uploads/".$tempPicsFileName);
			$image->move(public_path("uploads"), $tempPicsFileName);
			
			return view('customerDesign', ['tshirt' => session()->get('currentTshirt'), 'tshirtSize' => session()->get('currentTshirtSize'), 'custPicsSrc' => "uploads/".$tempPicsFileName]);
		}
	}	
	
}
