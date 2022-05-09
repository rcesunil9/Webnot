<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $d['totalSubAdmin']= User::where('userRole',config('services.userRole.SUBADMIN'))->count();
        $d['totalMasters']= User::where('userRole',config('services.userRole.MASTER'))->count();
        $d['totalSuperAgent']= User::where('userRole',config('services.userRole.SUPERAGENT'))->count();
        $d['totalAgent']= User::where('userRole',config('services.userRole.AGENT'))->count();
        $d['totalClient']= User::where('userRole',config('services.userRole.CLIENT'))->count();
        
        return view('dashboard',$d);
    }
}
