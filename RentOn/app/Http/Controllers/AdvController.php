<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SearchModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvController extends Controller
{
    /**
     * Display a listing of the advertisement.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
		if(Auth::user()->name == "myAdmin") {
			$userAdvs = \App\SearchModel::where('advUser',">",0)->paginate(5);
		} else {
			$userAdvs = \App\SearchModel::where('advUser',"=",Auth::user()->id)->paginate(5);
		}
        
        return view('advMan',['userAdvs'=>$userAdvs]);
    }

    /**
     * Show the form for creating a new advertisement.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advs.create');
    }

    /**
     * Store a newly created advertisement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'advTitle'=>['string', 'max:30','required'],
            'advAddress'=>['string','max:20','required'],
            'advSize'=>['integer','required'],
            'advPrize'=>['integer','required'],
            'advText'=>['string','required']
        ]);
        
		$moreImage = $request->advMorePics1.",".$request->advMorePics2.",".$request->advMorePics3;
		
        $adv = new SearchModel();
        
        $adv->title = $request->advTitle;
        $adv->rentOrSell = $request->advRS;
        $adv->city = $request->advAddress;
        $adv->size = $request->advSize;
        $adv->prize = $request->advPrize;
        $adv->advertisementText = $request->advText;
        $adv->advMainImage = $request->advMainPics;
        $adv->advMoreImage = $moreImage;		
        $adv->heatingSystem = $request->advHeatingSystem;
        $adv->advUser = Auth::user()->id;
        $adv->views = 0;
		$adv->Highlighted = 0;
		
        $adv->save();

        return redirect()->action('AdvController@index');
    }

    /**
     * Display the specified advertisement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $adv = \App\SearchModel::find($id);
		$moreImage1 = "";
		$moreImage2 = "";
		$moreImage3 = "";
		
		if(strlen($adv->advMoreImage)> 2) {
			$firstImageEnd = stripos($adv->advMoreImage,",");
			$secondImageEnd = strrpos($adv->advMoreImage,",");
			
			$moreImage1 = substr($adv->advMoreImage,0,$firstImageEnd);
			$moreImage2 = substr($adv->advMoreImage,$firstImageEnd+1,$secondImageEnd);
			$moreImage3 = substr($adv->advMoreImage,$secondImageEnd+1);
		}
		
        $view = $adv->views;
		$view++;
		\App\SearchModel::where('id','=',$id)->update(array('views'=>$view));
		
        return view('advs.show',['adv'=>$adv,'moreImage1'=>$moreImage1, 'moreImage2'=>$moreImage2, 'moreImage3'=>$moreImage3]);
    }

    /**
     * Show the form for editing the specified advertisement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adv = \App\SearchModel::find($id);
        
        return view('advs.edit',['adv'=>$adv]);
    }

    /**
     * Update the specified advertisement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $adv = \App\SearchModel::find($id);
               
        $request->validate([
            'advTitle'=>['string', 'max:30','required'],
            'advAddress'=>['string','max:20','required'],
            'advSize'=>['integer','required'],
            'advPrize'=>['integer','required'],
            'advText'=>['string','required']
        ]);
        
		$moreImage = $request->advMorePics1.",".$request->advMorePics2.",".$request->advMorePics3;
		
        $adv->title = $request->advTitle;
        $adv->rentOrSell = $request->advRS;
        $adv->city = $request->advAddress;
        $adv->size = $request->advSize;
        $adv->prize = $request->advPrize;
        $adv->advertisementText = $request->advText;
        $adv->advMainImage = $request->advMainPics;
		$adv->advMoreImage = $moreImage;
        $adv->heatingSystem = $request->advHeatingSystem;
        
        $adv->save();
        
        return redirect()->action('AdvController@index');
    }

    /**
     * Remove the specified advertisement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adv = \App\SearchModel::find($id);
        $adv->delete();
        
        return back();
    }
}
