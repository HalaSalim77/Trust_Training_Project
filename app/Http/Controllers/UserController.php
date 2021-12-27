<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    //


    public function index(Request $request, $id)
    {
        // find user 
        $user = User::find($id);

        // pass this single user object
        // deals with single eloquent model or row in database
        return new UserResource($user);
    }

    public function listAll(Request $request)
    {
        //to show more data 
        // get all user records
        //$users = User::all();
        $users = User::paginate();

        // pass all eloquent objects to user collection
        return new UserCollection($users);
    }
}
