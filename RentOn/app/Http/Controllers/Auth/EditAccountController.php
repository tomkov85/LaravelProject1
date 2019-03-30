<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class EditAccountController extends Controller
{
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
        ]);
        
			$user->name = $request->name;
			$user->email = $request->email;
			$user->email = $request->email;
			$user->updated_at = date('Y-m-d');
        
        $user->save();
        
        return redirect()->action('auth\EditAccountController@edit');
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
        
        return redirect()->action('SearchController@getTopAdvertisements');
    }
}
