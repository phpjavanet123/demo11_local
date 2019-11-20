<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //http://demo11.local/api/users
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientRequest $request
     * @return Response
     */
    public function store(ClientRequest $request)
    {
        //POST http://demo11.local/api/users
        /*
        $user =User::where('email', $request->get('email'))->first();
        if ($user) {
            throw new \Exception('User already exist!');
        }
        */

        $user = User::firstOrNew($request->only(['name', 'email', 'country', 'city']));
        $user->password = Hash::make($request->get('password'));
        $user->role_id = 2;
        $user->save();

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //http://demo11.local/api/users/16
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientRequest $request
     * @param User $user
     * @return Response
     */
    public function update(ClientRequest $request, User $user)
    {
        $user->fill($request->only(['name', 'email', 'country', 'city']));
        print_r($user->toArray());
        //$user->city = $request->get('city');
        //$user->fill($request->only(['name', 'email', 'country', 'city']));
        $user->save();
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        //$user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => true]);
    }
}
