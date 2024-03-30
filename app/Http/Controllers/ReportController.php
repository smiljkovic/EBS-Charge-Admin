<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reportGenerate($type)
    {
        if ($type == "user") {
            return view("reports.user-report");
        } 
        elseif ($type == "booking") {
            return view("reports.booking-report");
        } elseif ($type == "parking") {
            return view("reports.parking-report");
        } elseif ($type == "transaction") {
            return view("reports.transaction-report");
        } else {
            return false;
        }
    }
}
