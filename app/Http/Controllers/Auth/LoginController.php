<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


//    protected function validateLogin(Request $request)
//    {
//        // Get the user details from database and check if email is verified.
//        $user = User::where('email', '=', $request->email)->first();
//        if ($user->status == 0) {
//            return redirect()->route('login')->with('error', 'You are not allowed to access the system');
//
//        }
//        else{
//            $this->validate($request, [
//                $this->username() => 'required|string',
//                'password' => 'required|string',
//            ]);
//        }
//
//    }


    protected function credentials(\Illuminate\Http\Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['email' => $request->email, 'password' => $request->password, 'status' => 1];
    }


    protected function authenticated(Request $request) {
        $user_role=Auth::user()->role;
        if($user_role==User::business)
        {
            return redirect('/dashboard');
        }

        return redirect('/home');
    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
