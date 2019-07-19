<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageSettingsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	
	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showContacts()
    {
        $email = \App\PageSettingsModel::where('settingName','email')->first();
		$address = \App\PageSettingsModel::where('settingName','address')->first();
		$phone = \App\PageSettingsModel::where('settingName','phone')->first();
		
        return view('contact',['email'=>$email->settingValue,'phone'=>$phone->settingValue,'address'=>$address->settingValue]);
    }
	
	/**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers()
    {
		
		$users = \App\User::paginate(10);

        return view('auth.editAccountAll',['users'=>$users]);
    }
	
	/**
     * Display a listing of the messgaes.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllMessages()
    {
		
		$messages = \App\MessagesModel::orderBy('created_at','desc')->paginate(10);

        return view('messages.messageManager', ['messages' => $messages, 'type' => $_GET['type']]);
    }
	
    /**
     * Display a listing of the messgaes.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAdvs()
    {
		$userAdvs = \App\SearchModel::where('advUser',">",0)->paginate(5);
        
        return view('advMan',['userAdvs'=>$userAdvs]);
    }
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
		$email = \App\PageSettingsModel::where('settingName','email')->first();
		$address = \App\PageSettingsModel::where('settingName','address')->first();
		$phone = \App\PageSettingsModel::where('settingName','phone')->first();
		
        return view('admin',['email'=>$email->settingValue,'phone'=>$phone->settingValue,'address'=>$address->settingValue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'email'=>['string'],
            'address'=>['string'],
            'phone'=>['string'],
			
        ]);
		
		$email = \App\PageSettingsModel::where('settingName','email')->first();
		$address = \App\PageSettingsModel::where('settingName','address')->first();
		$phone = \App\PageSettingsModel::where('settingName','phone')->first();
		
		$email->settingValue = $request->email; 
		$address->settingValue = $request->address; 
		$phone->settingValue = $request->phone; 
		
		$email->save();
		$address->save();
		$phone->save();
		
		/*
		'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		if (!$request->hasFile('logo')) {
			return back();
		}else{
			
		}*/
		echo ($request->logo);
		
		$path = $request->file('logo')->storeAs('myLogo','RentOnlogo.jpg');
		return redirect()->action('SearchController@getTopAdvertisements');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
