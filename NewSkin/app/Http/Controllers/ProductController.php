<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{	
    /**
     * Display the home view
     *
     * @return index.blade.php
     */
	public function index() {
		$popularPicsTable = DB::table('tspics')->orderBy('orders','desc')->limit(4)->get();
		$tagTable = DB::table('tspics')->groupBy('tag')->get();
		return view('index', ['popularPicsTable' => $popularPicsTable, 'tagTable' => $tagTable]);
	}
	
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
     * Display the search view
     *
     * @return search.blade.php
     */
	
	public function showSearchPage() {
		$tagTable = DB::table('tspics')->groupBy('tag')->get();
		$searchTable = null;
		$popularPics = false;
		if(empty($_GET['searchField'])) {
			if(!empty($_GET['searchTag'])) {
				$searchByTagKeyWord = $_GET['searchTag'];
				$searchTable = DB::table('tspics')->where('tag',$searchByTagKeyWord)->orderBy('name','desc')->paginate(2);
			}
		} else {
			$keyword = $_GET['searchField'];
			$searchTable = DB::table('tspics')->where('name','like',"%$keyword%")->orderBy('name','desc')->paginate(2);
			if($_GET['searchTag'] != "All") {
				$searchByTagKeyWord = $_GET['searchTag'];
				$searchTable = DB::table('tspics')->where('name','like',"%$keyword%")->where('tag',$searchByTagKeyWord)->paginate(2);
			}
		}
		
		if($searchTable == null | (count($searchTable) == 0)) {
			$searchTable = DB::table('tspics')->orderBy('orders','desc')->limit(4)->get();
			$popularPics = true;
		}
		
		return view('search', ['searchTable' => $searchTable, 'tagTable' => $tagTable, 'popularPics'=> $popularPics]);
	}
	
	 /**
     * Checks and upload the customers picture
     *	param Request input
     * @return back to the source
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
