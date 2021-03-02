<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardAccountController extends Controller
{
    
    public function account()
    {
        $user = Auth::user();
        return view('pages-dashboard.dashboard-account', [
            'user' => $user
        ]); 
    }
}

