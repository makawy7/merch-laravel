<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Cookie;
use App\Cart;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {

      //if a guest has cart data stord in cookies, we store them in the database and delete cookie
      if (Cookie::get('cart_data') !== null){
        auth()->user()->carts()->delete();
        $cookies=Cookie::get('cart_data');
        $cookies=json_decode($cookies);
        foreach($cookies as $cookie){

          if($cookie->extoption==''){
            Cart::create([
              'product_id'=>$cookie->product,
              'quantity'=>$cookie->quantity,
              'user_id'=>$user->id,
            ]);
          }else {
            Cart::create([
              'product_id'=>$cookie->product,
              'extoption_id'=>$cookie->extoption,
              'quantity'=>$cookie->quantity,
              'user_id'=>$user->id,
            ]);
          }

        }

        //delete the cookie
        Cookie::queue(Cookie::forget('cart_data'));
      }

      //redirect to admin page
      if(url()->previous()==route('adminlogin') && $user->admin()){
          return redirect()->route('admindash');
      }


    }
}
