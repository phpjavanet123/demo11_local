<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Hash;

class Client2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
        'surname'=> 'required',
      ]);
	  
      $client = new Client([
        'name' => $request->get('name'),
        'surname'=> $request->get('surname'),
        'email'=> $request->get('email'),
          //TODO:: can be replaced to MD5 and moved to separate class HashUtil.php and can be used for Clients as well
        'password' => Hash::make($request->get('password')),
      ]);
      $client->save();
	  
      return redirect('/clients')->with('success', 'Client has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$client = Client::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit', compact('client'));
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
        'surname'=> 'required',
      ]);

      $client = Client::find($id);
      $client->name = $request->get('name');
      $client->surname = $request->get('surname');
      $client->save();

      return redirect('/clients')->with('success', 'Client has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$client = Client::find($id);
		$client->delete();

		return redirect('/clients')->with('success', 'Client has been deleted Successfully');
    }
}
