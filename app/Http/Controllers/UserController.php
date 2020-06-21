<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=User::whereNotIn('role',[User::super_admin, User::business])->get();
        return view('system_users.admins',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha_num|max:255',
            'surname' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|numeric|digits_between:10,15',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->password = bcrypt(strtolower('turbo1234'));
        $user->user_create_id = Auth::user()->id;
        $user->created_at = date("Y-m-d H:i:s");
        if ($user->save()) {
            return redirect()->back()->with('success', sprintf('User was created successfully'));
        } else {
            return redirect()->back()->with('error', sprintf('An error has occurred. Please try again later'));
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha_num|max:255',
            'surname' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|numeric|digits_between:10,15',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }

        $user = User::findorFail($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->user_create_id = Auth::user()->id;
        $user->created_at = date("Y-m-d H:i:s");
        if($request->password=='yes')
        {
            $user->password=bcrypt('turbo1234');
        }
        if ($user->save()) {
            return redirect()->back()->with('success', sprintf('User was updated successfully'));
        } else {
            return redirect()->back()->with('error', sprintf('An error has occurred. Please try again later'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);
        if($user->delete()) {
            return redirect()->route('admin.index')->with('success', sprintf('User deleted successfully'));
        } else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }
    }

    public function admin_edit_profile()
    {
        return view('system_users.edit_profile');
    }

    public function submit_admin_edit_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'surname' => 'required|max:191',
            'email' => 'required|max:191|unique:users,email,'.auth()->id(),
            'phone' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', sprintf( $validator->errors()->all()[0]));
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($user->save()) {
            return redirect()->back()->with('success', sprintf('You profile was saved successfully'));
        } else {
            return redirect()->back()->with('error', sprintf('An error has ocurred. Please try again later'));
        }
    }

    public function change_password(Request$request)
    {
        $validator = Validator::make($request->all(),
            [
                'password' => 'confirmed',
                'old_password' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', sprintf( $validator->errors()->all()[0]));
        }

        $user = User::find(Auth::user()->id);
        $oldPassword  = $request->old_password;
        $newPassword = $request->password;
        $hashedPassword = $user->password;
        if (Hash::check($oldPassword, $hashedPassword)) {
            $user->password = Hash::make($newPassword);
        }
        else {
            return redirect()->back()->with('warning', sprintf('Please enter correct your old password'));
        }
        if($user->save()) {
            return redirect()->back()->with('success', sprintf('Password changed sucessfully.'));
        }
        else {
            return redirect()->back()->with('error', sprintf('An error has ocurred. Please try again later'));
        }

    }


}
