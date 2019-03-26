<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
	private $whereArray = array();
    function show() {			
		
		SearchController::addWhere('searchLoc','city','like');
		SearchController::addWhere('searchSizeMin','size','>');
		SearchController::addWhere('searchSizeMax','size','<');
		SearchController::addWhere('rentOrSell','sellOrRent','=');
		$users = DB::table('advertisements')->where($this->whereArray)->get();
		return view('search',['in'=>$users]);
	}
	
	function addWhere($inputName,$dbCol,$dbRel) {
		if(!empty($_GET[$inputName])) {
			if($dbRel==='like') {
				$this->whereArray[count($this->whereArray)] = [$dbCol,$dbRel,'%'.$_GET[$inputName].'%'];
			} else {
				$this->whereArray[count($this->whereArray)] = [$dbCol,$dbRel,$_GET[$inputName]];
			}						
		}
	}
}
