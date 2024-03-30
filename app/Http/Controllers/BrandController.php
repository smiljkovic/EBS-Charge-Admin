<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("brand.index");
    }

    public function save($id=null)
    {
        return view('brand.save', compact('id'));
    }

}