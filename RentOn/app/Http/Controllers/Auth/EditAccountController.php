<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class EditAccountController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$users = \App\User::all();

        return view('auth.editAccountAll',['users'=>$users]);
    }
	
	
	/**
     * Show the form for editing the specified account.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = \App\User::find((Auth::user()->id));
        
        return view('auth.editAccount',['user'=>$user]);
    }
	
	/**
     *Show the form for editing the specified account for the admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminEdit($id)
    {
        $user = \App\User::find($id);
        
        return view('auth.editAccount',['user'=>$user]);
    }
	
	 /**
     * Update the specified account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = \App\User::find((Auth::user()->id));
               
        $request->validate([
            'name' => ['string', 'max:255','required'],
            'email' => ['string', 'email', 'max:255','required'],
            'password' => ['string', 'min:8','required'],
			'address' => ['string', 'max:255'],
			'phone' => ['string', 'max:20'],
        ]);
        
			$user->name = $request->name;
			$user->email = $request->email;
			$user->address = $request->address;
			$user->phone = $request->phone;
			$user->updated_at = date('Y-m-d');
        
        $user->save();
        
        return redirect()->action('auth\EditAccountController@edit')->with('status', 'Account updated!');
    }
	
	/**
     * Remove the specified account from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = \App\User::find((Auth::user()->id));

        $user->delete();
        
        return redirect()->action('SearchController@getTopAdvertisements')->with('status', 'Account deleted!');
    }
	
	/**
     * Admin can remove the specified account from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminDestroy($id)
    {
        $user = \App\User::find($id);

        $user->delete();
        
        return redirect()->action('SearchController@getTopAdvertisements')->with('status', 'Account deleted!');
    }
}
