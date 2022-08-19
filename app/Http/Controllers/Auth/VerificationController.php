<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Notifications\PointsEarned;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();
        session()->flash('success','Verification Email Has Been Sent To Your Email.');
        return back()->with('resent', true);
    }

    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        //Add Reward Points If Enabled
        if(reward()->email==1){
          auth()->user()->update([
            'points'=>auth()->user()->points+reward()->email_points
          ]);
          $details=[
            'type'=>'reward',
            'for'=>'email',
            'product_id'=>'',
            'points'=>reward()->email_points,
          ];
          auth()->user()->notify(new PointsEarned($details));
        }

        session()->flash('success','Email Has Been Successfully Verified.');
        return redirect($this->redirectPath())->with('verified', true);
    }

}
