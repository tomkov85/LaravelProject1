<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
	private $whereArray = array();
    function show() {					
		SearchController::addWhere('searchLoc','city','like');
		SearchController::addWhere('searchSizeMin','size','>');
		SearchController::addWhere('searchSizeMax','size','<');
		SearchController::addWhere('rentOrSell','sellOrRent','=');
		
		if(empty($_GET['order'])) {
			$order = "size";
		} else {
			$order = $_GET['order'];
		}
		
		if(empty($_GET['pageLimit'])) {
			$pl = 2;
		} else {
			$pl = $_GET['pageLimit'];
		}
		
		$users = DB::table('advertisements')->where($this->whereArray)->orderBy($order,'desc')->paginate($pl);
		return view('search',['in'=>$users, 'order'=>$order, 'pageLimit'=>$pl]);
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
	
	function showAdv() {					
		$adv = DB::table('advertisements')->where('id','=',$_GET['id'])->get()->first();
		return view('selected',['adv'=>$adv]);
	}
}
