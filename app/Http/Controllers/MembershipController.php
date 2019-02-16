<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $memberships = \App\Membership::all();
        return view('admin/user/createUser', compact('memberships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'membership' => 'required',
            'email' => 'required|unique:users',
            'oldPassword' => 'required',
        ]);

        $user = new \App\User;
        $password = Hash::make($request->get('password'));
        $user->name = $request->get('name');
        $user->membership = $request->get('membership');
        $user->email = $request->get('email');
        $user->password = $password;
        $user->save();

        return redirect('blog/admin')->with('success', 'Data user telah ditambahkan'); 
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
        $user = \App\User::find($id);
        $memberships = \App\Membership::all();
        return view('admin/user/editUser',compact('user', 'memberships'));  
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
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'membership' => 'required',
            'email' => 'required',
            'oldPassword' => 'required',
        ]);

        $user = \App\User::find($id);
        $user->name = $request->get('name');
        $user->membership = $request->get('membership');
        $user->email = $request->get('email');

        if ($request->get('didIChangeMyPassword') == "1") {
            $user->password = $request->get('password');
        }

        $user->password = $request->get('oldPassword');
        $user->save();

        return redirect('blog/admin')->with('success', 'Data user telah diubah'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = \App\User::find($id);
        $user->delete();
        return redirect('blog/admin')->with('success','Data user telah di hapus');
    }
}