<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Http\Requests\RegisterVehicle;
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

    public function store(RegisterVehicle $request)
    {
        $vehicle = Vehicle::make($request->validated());
        $request->user()->vehicles()->save($vehicle);
        return $vehicle;
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return $vehicle;
    }

}
