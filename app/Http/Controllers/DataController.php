<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Role;
use App\User;

class DataController extends Controller
{
    public function open() 
    {
        $data = "This data is open and can be accessed without the client being authenticated";
        return response()->json(compact('data'),200);

    }

    public function closed() 
    {
        $data = "Only authorized users can see this";
        return response()->json(compact('data'),200);
    }

    public function roles(){
        return Role::all();
    }

    public function users(){
        return User::all();
    }
}
