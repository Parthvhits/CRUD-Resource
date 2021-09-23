<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JsValidator;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $validationRules = [
        'user_name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|digits:10',
        'gender' => 'required',
        'password' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $this->data['allContent'] = User::all();
        return view('Backend.User.list',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidator::make($this->validationRules);
        return view('Backend.User.add')->with(['validator' => $validator]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validationRules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        $data = $request->all();
        $data['password']=Hash::make($data['password'] );
        User::create($data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        $this->data['allContent'] = $users;
        $this->data['validator'] = JsValidator::make($this->validationRules);
        return view('Backend.User.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $users = User::find($id);
        $users->user_name = $input['user_name'];
        $users->email = $input['email'];
        $users->phone = $input['phone'];
        $users->gender = $input['gender']; 
        $users->save();
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auth = Auth::user();
        $user_id = User::find($id);
        $deleteArray = array(
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => $auth->id
        );
        $update = User::where('id',$user_id->id)->update($deleteArray);
        return redirect('/');
    }
}
