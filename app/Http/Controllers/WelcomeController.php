<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $adminExists = Admin::count() > 0;
        return view('welcome', compact('adminExists'));
    }

}
