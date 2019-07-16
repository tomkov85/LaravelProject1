<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\SearchModel;

class SearchController extends Controller
{
	private $whereArray = array();
	private $linkArray = '';
	
	/**
     * Show the result of the advertisements search
     *
     * @return \Illuminate\Http\Response
     */
    function showSearchResult() {					
		$this->setWhereArray();
		
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
		
		if(empty($_GET['page'])) {
			$currentPage = 0;
			$currentFinds = 1;
		} else {
			$currentPage = $_GET['page'];
			$currentFinds = (($currentPage - 1) * $pl) + 1;
		}
		
		$advsAll = \App\SearchModel::where($this->whereArray);
		$all = $advsAll->count();
		$advs=$advsAll->orderBy('Highlighted','desc')->orderBy($order,'desc')->paginate($pl);
		
		$currentFindsMax = $this->getCurrentMaxPage($all, $pl, $currentPage);
		
		return view('search',['in'=>$advs, 'order'=>$order, 'pageLimit'=>$pl, 'finds'=>$all, 'cf'=>$currentFinds, 'cfm'=>$currentFindsMax, 'linkArray' => $this->linkArray]);
	}
	
	/**
     * Sets the where options
     *
     * @return void
     */
	function setWhereArray() {		
		if(isset($_GET['searchSubmit']) || empty(session()->get('warray'))) {
			$this->addToWhereArray('searchLoc','city','like');
			$this->addToWhereArray('searchSizeMin','size','>');
			$this->addToWhereArray('searchSizeMax','size','<');
			$this->addToWhereArray('rentOrSell','rentOrSell','=');

			session()->put('warray',$this->whereArray);		
		} else {				
			$this->whereArray = session()->get('warray');
		}
	}
	
	/**
     * Add an element to where array, if the get request is set
	 *
	 *@param  String  $inputName
	 *@param  String  $dbCol
	 *@param  String  $dbRel
     *
     * @return void
     */
	function addToWhereArray($inputName,$dbColumn,$dbRelation) {
		if(!empty($_GET[$inputName])) {
			if($dbRelation==='like') {
				$this->whereArray[count($this->whereArray)] = [$dbColumn,$dbRelation,'%'.$_GET[$inputName].'%'];
			} else {
				$this->whereArray[count($this->whereArray)] = [$dbColumn,$dbRelation,$_GET[$inputName]];
			}						
		}
	}
	
	/**
     * Returns the best advertisements
     *
     * @return \Illuminate\Http\Response
     */
	function getTopAdvertisements() {				
	$advs = \App\SearchModel::where('views','>',0)->orderBy("views",'desc')->limit(10)->get();
			
		return view('home',['advs'=>$advs]);
	}
	
	/**
     * Calculate the current max page
     *
	 *@param  $all array
	 *@param  $pageLimit Integer
	 *@param  $currentPage Integer
	 *
     * @return Integer
     */
	 function getCurrentMaxPage($all, $pageLimit, $currentPage) {
		 if($all <= $pageLimit) {
			 return 0;
		 } else {
			 if($currentPage===0) {
				return $pageLimit;
			} else {
				if(($currentPage * $pageLimit) > $all) {
					return $all;
				} else {
					return $currentPage*$pageLimit;
				}
			}
		}
	 }
}
