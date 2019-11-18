<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO::: Can be moved to Request separate object and checked there - to make controller more clean
      $request->validate([
        'name'=>'required',
        'email'=> 'required',
        'password'=> 'required',
      ]);
	  
      $user = new User([
        'name' => $request->get('name'),
        'email'=> $request->get('email'),
        //TODO:: can be replaced to MD5 and moved to separate class HashUtil.php and can be used for Clients as well
        'password' => Hash::make($request->get('password')),
        'role_id' => 2,
        //'email'=> $request->get('name') . rand(1,99999) . '@mail.com',
      ]);
      $user->save();
	  
      return redirect('/users')->with('success', 'User has been added');
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
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
      //TODO::: Can be moved to Request separate object and checked there - to make controller more clean
      $request->validate([
        'name'=>'required',
        'email'=> 'required',
      ]);

      $user = User::find($id);
      $user->name = $request->get('name');
      $user->email = $request->get('email');
      if (!empty($request->get('password'))) {
          $user->password = Hash::make($request->get('password'));
      }
      $user->save();

      return redirect('/users')->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = User::find($id);
		$user->delete();

		return redirect('/users')->with('success', 'User has been deleted Successfully');
    }
}
