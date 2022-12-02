<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Charity;
use App\Models\Expenditure;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function donors()
    {
        $donors = Donor::orderBy('id','desc')->get() ;
        return view('backend.admin.donors.index',compact('donors'));
    }

    public function charity()
    {
        $charity = Charity::orderBy('id','desc')->get();
         
        return view('backend.admin.charity.index',compact('charity'));
    }

    public function expenditures()
    {
        $expenditures = Expenditure::orderBy('id','desc')->get();
        return view('backend.admin.expenditures.index',compact('expenditures'));
    }
}
