<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class PageController extends Controller
{
    /**
     * Display the home view
     *
     * @return \Illuminate\Http\Response
     */
	public function index() {
		$popularPicsTable = DB::table('tspics')->orderBy('orders','desc')->limit(4)->get();
		$tagTable = DB::table('tspics')->groupBy('tag')->get();
		return view('index', ['popularPicsTable' => $popularPicsTable, 'tagTable' => $tagTable]);
	}

	 /**
     * Display the search view
     *
     * @return \Illuminate\Http\Response
     */
	
	public function showSearchPage() {
		$tagTable = DB::table('tspics')->groupBy('tag')->get();
		$searchTable = null;
		$popularPics = false;
		if(empty($_GET['searchField'])) {
			if(!empty($_GET['searchTag'])) {
				$searchByTagKeyWord = $_GET['searchTag'];
				$searchTable = DB::table('tspics')->where('tag',$searchByTagKeyWord)->orderBy('name','desc')->paginate(20);
			}
		} else {
			$keyword = $_GET['searchField'];
			$searchTable = DB::table('tspics')->where('name','like',"%$keyword%")->orderBy('name','desc')->paginate(20);
			if($_GET['searchTag'] != "All") {
				$searchByTagKeyWord = $_GET['searchTag'];
				$searchTable = DB::table('tspics')->where('name','like',"%$keyword%")->where('tag',$searchByTagKeyWord)->paginate(20);
			}
		}
		
		if($searchTable == null | (count($searchTable) == 0)) {
			$searchTable = DB::table('tspics')->orderBy('orders','desc')->limit(4)->get();
			$popularPics = true;
		}
		
		return view('search', ['searchTable' => $searchTable, 'tagTable' => $tagTable, 'popularPics'=> $popularPics]);
	}
	
	/**
     * Display the delivery view
     *
     * @return \Illuminate\Http\Response
     */
	public function showDeliveryPage() {
		return view('delivery');
	}
	
	/**
     * Display the contact view
     *
     * @return \Illuminate\Http\Response
     */
	public function showContactPage() {
		return view('contact');
	}
}
