<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        return view("coupon.index");
    }

    public function save($id)
    {
    	return view('coupon.save', compact('id'));
    }

}
