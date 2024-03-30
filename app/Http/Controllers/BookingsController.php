<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($id=null)
    {

        return view("bookings.index")->with('id',$id);
    }


    public function show($id)
    {
        return view('bookings.show')->with('id', $id);
    }


}