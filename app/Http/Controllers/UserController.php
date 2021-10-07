<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class UserController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function index()
    {
      //$r= Request->path();
//echo $r;
      $users = User::simplePaginate(5);;
      //var_dump($us);
        return view('users',compact('users'))
          ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function logout() {
        Auth::logout();
        return redirect('/user');
    }
}