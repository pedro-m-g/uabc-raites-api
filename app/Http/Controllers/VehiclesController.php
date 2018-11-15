<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehiclesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        return $request->user()->vehicles;
    }

    public function store(Request $request)
    {
        
    }

}
