<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PagesController extends Controller
{
    public function home()
    {
        return view('backend.home');
    }

    public function dashboard()
    {
    	return Auth::user();
    }
}