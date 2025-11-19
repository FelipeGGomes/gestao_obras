<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        User::all();
        return response()->json([
            'status' => 'OK',
            'users' => User::all(),                
        ], status: 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());
    }

  
    public function show(string $id)
    {
        return response()->json([
            'status' => 'OK',
            'user' => User::findOrFail($id),                
        ], status: 200);
    }

    /** 
     * Show the form for editing the specified resource.
     */
   
  public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);
    $user->update($request->all());
    return response()->json([
        'status' => 'OK',
        'user' => $user,                
    ], status: 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $user = User::findOrFail($id);
       $user->delete();
    }
}
