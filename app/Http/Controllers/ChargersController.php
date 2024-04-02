<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ChargersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return view("chargers.index");
    }
    public function show($id){
        return view("chargers.show")->with('id',$id);

    }
    public function save($id=null){
        return view("chargers.save")->with('id', $id);

    }




}
