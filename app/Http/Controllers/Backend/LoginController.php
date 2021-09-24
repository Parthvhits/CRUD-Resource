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
        $data = User::CheckContactRegister($cno);
        if($data)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function checkContactEdit(Request $request)
    {
        $cno = $request->cno;
        $id = $request->id;
        $data = User::CheckContactEdit($cno,$id);
        if($data)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $data = User::CheckEmailRegister($email);
        if($data)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function checkEmailEdit(Request $request)
    {
        $email = $request->email;
        $id = $request->id;
        $data = User::CheckEmailEdit($email,$id);
        if($data)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }
}
