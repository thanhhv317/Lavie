<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\User;
use Hash;
use Socialite;
use App\Http\Requests\BuyerRequest;

class BuyerController extends Controller
{
    public function redirectToProvider($socialite)
    {
        return Socialite::driver($socialite)->redirect();
    }

    /**
     * Obtain the user information from facebook, google.
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

    public function postLogin(BuyerRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $credentials = [ 'email' => $request->email , 'password' => $password ];

        
        if(Auth::attempt($credentials, $request->remember)){
            //login successful, redirect the user to your preferred url/route...
            return redirect()->route('homePage');
        } else {
            return redirect()->back();
        }
    }

    public function getPayment()
    {
        return view('homepage.buyerPayment');
    }

    public function getProfile()
    {
        if(Auth::check())
        {
            return view('homepage.userProfile');
        }
    }

    public function postProfile(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->arr;
            $id = Auth::user()->id;
            $user = new User;
            $user = $user->editDataById($id, $data);
            return 1;
        }
        else
        {
            return "not found";
        }
    }

    public function postChangePassword(Request $request)
    {
        if($request->ajax())
        {
            $newPass     = $request->newPass;
            $confirmPass = $request->confirmPass;

            if($newPass == $confirmPass) {
                $newPass = Hash::make($newPass);
                $user = new User;
                $user = $user->editPassword(Auth::user()->id, $newPass);
            }
            return 1;
        }
        else
        {
            return "not found";
        }
    }

    public function listOrder(Request $request)
    {
        if($request->ajax())
        {
            $order = new Order;
            $order = $order->getAllOrderByBuyerId(Auth::user()->id, $request->skip);

            return $order;
        }
        else
        {
            return "not found";
        }
    }

    public function getInfoAccount(Request $request)
    {
        if($request->ajax())
        {
            $user = new User;
            $user = $user->getDataById(Auth::user()->id);
            return $user;
        }
        else
        {
            return "not found";
        }
    }

}
