<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use App\Cart;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required'],
            'birthday' => ['required'],
            'phone' => ['required','numeric','unique:users'],
            'code' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user=User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'phone' => $data['phone'],
          'country_code' => $data['code'],
          'gender' => $data['gender'],
          'birthday' => $data['birthday'],
          'currency' => setting()->default_currency,
          'password' => Hash::make($data['password']),
        ]);

        //if a guest has cart data stord in cookies, we store them in the database and delete cookie
        if (Cookie::get('cart_data') !== null){
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

        return $user;

    }
}
