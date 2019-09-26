<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageSettingsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\User;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	
	/**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers()
    {
		if(!empty($_GET['searchVal'])) {
			$searchVal = $_GET['searchVal'];
			$searchName = $_GET['searchName'];
			
			$users = \App\User::where($searchName,'like','%'.$searchVal.'%')->orderBy('created_at','desc');
		} else {
			$users = \App\User::orderBy('created_at','desc');
		}	
		/*
		$col = Schema::getColumnListing('users');
		echo $col[2];
		*/
		$users = $users->paginate(10);

        return view('admin.editAccountAll',['users'=>$users]);
    }
	
	/**
     * Display a listing of the messgaes.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllMessages()
    {
		$type = 'all';
		
		if(!empty($_GET['type'])) {
			$type = $_GET['type'];
		}
		if(!empty($_GET['searchVal'])) {
			$searchVal = $_GET['searchVal'];
			$searchName = $_GET['searchName'];
			
			$messages = \App\MessagesModel::where($searchName,'like','%'.$searchVal.'%')->orderBy('created_at','desc');
		} else {
			$messages = \App\MessagesModel::orderBy('created_at','desc');
		}	
		/*
		$col = Schema::getColumnListing('users');
		echo $col[2];
		*/
		$messages = $messages->paginate(10);

        return view('admin.messageManager', ['messages' => $messages, 'type' => $type]);
    }
	
    /**
     * Display a listing of the messgaes.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAdvs()
    {
		if(!empty($_GET['searchVal'])) {
			$searchVal = $_GET['searchVal'];
			$searchName = $_GET['searchName'];
			
			$userAdvs = \App\SearchModel::where($searchName,'like','%'.$searchVal.'%')->orderBy('created_at','desc');
		} else {
			$userAdvs = \App\SearchModel::orderBy('created_at','desc');
		}	
		/*
		$col = Schema::getColumnListing('users');
		echo $col[2];
		*/
		$userAdvs = $userAdvs->paginate(10);
        
        return view('admin.advMan',['userAdvs'=>$userAdvs]);
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
		
        return view('admin.admin',['email'=>$email->settingValue,'phone'=>$phone->settingValue,'address'=>$address->settingValue]);
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
