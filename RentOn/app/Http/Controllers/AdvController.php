<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SearchModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $userAdvs = \App\SearchModel::where('advUser',"=",Auth::user()->id)->paginate(5);
        
        return view('advMan',['userAdvs'=>$userAdvs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'advTitle'=>'required',
            'advRS'=>'required',
            'advAddress'=>'required',
            'advSize'=>'required',
            'advPrize'=>'required',
            'advText'=>'required',
        ]);
        
        $adv = new SearchModel();
        
        $adv->title = $request->advTitle;
        $adv->rentOrSell = $request->advRS;
        $adv->city = $request->advAddress;
        $adv->size = $request->advSize;
        $adv->prize = $request->advPrize;
        $adv->advertisementText = $request->advText;
        $adv->advImage = $request->advPics;
        $adv->heatingSystem = $request->advHeatingSystem;
        $adv->advUser = Auth::user()->id;
        
        $adv->save();

        return redirect()->action('AdvController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $adv = \App\SearchModel::find($id);
        
        return view('advs.show',['adv'=>$adv]);
    }

    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $adv = \App\SearchModel::find($id);
               
        $request->validate([
            'advTitle'=>'required',
            'advRS'=>'required',
            'advAddress'=>'required',
            'advSize'=>'required',
            'advPrize'=>'required',
            'advText'=>'required',
        ]);
        
        $adv->title = $request->advTitle;
        $adv->rentOrSell = $request->advRS;
        $adv->city = $request->advAddress;
        $adv->size = $request->advSize;
        $adv->prize = $request->advPrize;
        $adv->advertisementText = $request->advText;
        $adv->advImage = $request->advPics;
        $adv->heatingSystem = $request->advHeatingSystem;
        
        
        $adv->save();
        
        return redirect()->action('AdvController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adv = new SearchModel();
        
        $adv = \App\SearchModel::find($id);
        $adv->delete();
        
        return redirect()->action('SearchController@getTopAdvertisements');
    }
}
