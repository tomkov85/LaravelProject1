<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
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
     * Display the delivery view
     *
     * @return delivery.blade.php
     */
	public function showDeliveryPage() {
		return view('delivery');
	}
	
	/**
     * Display the delivery view
     *
     * @return delivery.blade.php
     */
	public function showContactPage() {
		return view('contact');
	}
}
