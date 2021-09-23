<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JsValidator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $this->data['validator'] = JsValidator::make($this->validationRules);
        return view('Backend.User.login',$this->data);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $validation = Validator::make($credentials, $this->validationRules);
        if (Auth::attempt($credentials)) {
            $users = User::all();
            return redirect('/user');   
        }
        else {
            return redirect()->back()->withErrors($validation->errors());
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function checkContact(Request $request)
    {
        
        $cno = $request->cno;
        
        $data = User::where('phone', $cno)->first();
        
        if($data)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }
}
