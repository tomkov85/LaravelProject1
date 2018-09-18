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
		$tagTable = DB::table('tspics')->orderBy('orders','desc')->limit(4)->get();
		return view('index', ['popularPicsTable' => $popularPicsTable, 'tagTable' => $tagTable]);
	}
	
	 /**
     * Display the home view
     *
     * @return index.blade.php
     */
	public function show($name) {
		$tshirtpics = DB::table('tspics')->get()->where('name',$name)->first();
		$tshirtColor = $_GET['color'];
		$tshirtSize = $_GET['size'];
		$tshirt = DB::table('tshirts')->get()->where('color',$tshirtColor)->first();
		$picsDesigner = DB::table('users')->get()->where('userId',$tshirtpics->designer)->first();
		return view('show', ['tshirtpics' => $tshirtpics, 'tshirt' => $tshirt, 'tshirtSize' => $tshirtSize, 'picsDesigner' => $picsDesigner]);
	}
}
