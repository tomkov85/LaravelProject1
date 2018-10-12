<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	/**
     * Display the change password form.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
		return view('auth.passwords.change');
    }
	
    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function showUserDatas()
    {
		$userDatas = Auth::user();
        return view("auth.manageUserAccount", ['userName' => $userDatas->name, 'userEmail' => $userDatas->email, 
		    'userAddress' => $userDatas->address, 'userPhone' => $userDatas->telephone]);
    }
	

    /**
     * Update the user datas.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateUserDatas(Request $request)
    {
        $this->validate($request, $this->userDatasRules(), $this->validationErrorMessages());
		
		$user->name = $request->name;
		
		$user->email = $request->email;
		
		$user->address = $request->address;
		
		$user->telephone = $request->phoneNumber;
		
		$user->updated_at = now();

        $user->save();
		
		return back();
    }

	/**
     * Update the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, $this->changePasswordRules(), $this->validationErrorMessages());
		if($request->password === $request->password_confirmation) {
			$user = Auth::user();

				$user->password = Hash::make($request->password);

				$user->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));

				Auth::guard()->login($user);
				
				return $this->showUserDatas();
		}
    }
	
    /**
     * Remove the account from storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
		Auth::logout();
		$user->delete();
		return redirect()->route('home');
    }
	
	/**
     * Get the data modification validation rules.
     *
     * @return array
     */
    protected function userDatasRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
			'phoneNumber' => 'required|integer',
        ];
    }

	/**
     * Get the data modification validation rules.
     *
     * @return array
     */
    protected function changePasswordRules()
    {
        return [
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6',
        ];
    }
	
	
    /**
     * Get the data modification validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }
	
	/**
     * Logs out the user
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
		Auth::logout();
		return back();
    }
}
