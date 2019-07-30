<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Socialite;

class BuyerController extends Controller
{
    public function redirectToProvider($socialite)
    {
        return Socialite::driver($socialite)->redirect();
    }

    // public function __construct()
    // {
    //     //redirect to homepage if go to signin url while signined
    //     $this->middleware('guest')->except('logout');
    // }
 
    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($socialite)
    {
        $user = Socialite::driver($socialite)->user();
 
        $authUser = $this->findOrCreateUser($user);
        
        Auth::login($authUser, true);
    
        return redirect()->route('buyer.payment');
    }
 
    private function findOrCreateUser($socialiteUser)
    {
        $authUser = User::where('provider_id', $socialiteUser->id)->first();
 
        if ($authUser) {
            return $authUser;
        }
 
        return User::create([
            'name' => $socialiteUser->name,
            'level' => 0,
            'password' => $socialiteUser->token,
            'email' => $socialiteUser->email,
            'phone' => '032222222',
            'provider' => $socialiteUser->id,
            'provider_id' => $socialiteUser->id,
            'image' => $socialiteUser->avatar,
        ]);
    }

    public function getLogin()
    {
        if(Auth::check()) return redirect()->back();
        return view('homepage.buyerSignin');
    }

    public function getPayment()
    {
        return view('homepage.buyerPayment');
    }

}
