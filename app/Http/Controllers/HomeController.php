<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analysis;
use App\Analyses;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
              $reports = Analysis::latest()->orderBy('created_at', 'desc')->paginate(20);
        return view('allreports', ['reports' => $reports]);
    }
}

