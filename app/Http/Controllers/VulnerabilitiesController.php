<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vulnerabilities;

class VulnerabilitiesController extends Controller
{
    public function index(){
        $vulnerabilities = Vulnerabilities::all();
        return $vulnerabilities;
    }
}
