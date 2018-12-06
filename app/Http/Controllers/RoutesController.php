<?php

namespace App\Http\Controllers;

use App\Route;
use App\RouteItem;
use App\Http\Requests\CreateRouteRequest;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return auth()->user()->routes;
    }

    public function store(CreateRouteRequest $request)
    {
        $data = $request->validated();
        $route = Route::make([
            'name' => $data['name']
        ]);
        auth()->user()->routes()->save($route);
        foreach ($data['items'] as $index => $place) {
            $item = RouteItem::make([
                'index' => $index,
                'place' => $place
            ]);
            $route->items()->save($item);
        }
        return $route;
    }

    public function destroy(Route $route)
    {
        $route->items()->delete();
        $route->delete();
        return $route;
    }

}
