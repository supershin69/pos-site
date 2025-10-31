<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    // Direct Dashboard
    public function dashboard() {
        return view("admin.dashboard.home");
    }
}
