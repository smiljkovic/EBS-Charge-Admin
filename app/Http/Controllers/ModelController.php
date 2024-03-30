<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("models.index");
    }

    public function save($id = null)
    {
        return view('models.save', compact('id'));
    }

}