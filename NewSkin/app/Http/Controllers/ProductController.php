<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display the home view
     *DB::table('tspics')->groupBy('tag')->get();
     * @return index.blade.php
     */
	public function index() {
		$popularPicsTable = DB::table('tspics')->orderBy('orders','desc')->limit(4)->get();
		$tagTable = DB::table('tspics')->groupBy('tag')->get();
		return view('index', ['popularPicsTable' => $popularPicsTable, 'tagTable' => $tagTable]);
	}
	
	 /**
     * Display the home view
     *
     * @return index.blade.php
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
	
	public function customersShow() {
		if(empty($_GET['color'])) {
			$tshirtColor = "white";
			$tshirtSize = "M";
		} else {
			$tshirtColor = $_GET['color'];
			$tshirtSize = $_GET['size'];
		}
		$tshirt = DB::table('tshirts')->get()->where('color',$tshirtColor)->first();
		
		return view('customerDesign', ['tshirt' => $tshirt, 'tshirtSize' => $tshirtSize]);
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
				$searchTable = DB::table('tspics')->where('tag',$searchByTagKeyWord)->orderBy('name','desc')->paginate(12);
			}
		} else {
			$keyword = $_GET['searchField'];
			$searchTable = DB::table('tspics')->where('name','like',"%$keyword%")->orderBy('name','desc')->paginate(12);
			if($_GET['searchTag'] != "All") {
				$searchByTagKeyWord = $_GET['searchTag'];
				$searchTable = DB::table('tspics')->where('name','like',"%$keyword%")->where('tag',$searchByTagKeyWord)->paginate(12);
			}
		}
		
		if($searchTable == null | (count($searchTable) == 0)) {
			$searchTable = DB::table('tspics')->orderBy('orders','desc')->limit(4)->get();
			$popularPics = true;
		}
		
		return view('search', ['searchTable' => $searchTable, 'tagTable' => $tagTable, 'popularPics'=> $popularPics]);
	}
	
	public function checkPics(){
		$fileName = basename($fileData["imageUpload"]);
		echo $fileName;
	}
	
}
