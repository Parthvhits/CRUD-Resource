<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JsValidator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $validationRules = [
        'user_name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|digits:10',
        'gender' => 'required',
        'password' => 'required',
    ];
    public function index(Request $request)
    {
        $validator = JsValidator::make($this->validationRules);
        return view('Backend.User.login')->with(['validator' => $validator]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $users = User::all();
            return redirect('/user');   
        }
        else {
            return redirect()->back();   
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
