<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function suggestion(Request $request)
    {
        if($request->has('query')){
            return City::query()->with('region')->whereLike('name', '%' . $request->get('query') . '%')->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'label' => $item->name,
                    'region' => $item->region->name . ' ' . $item->region->country->name,
                ];
            });
        }
        return City::query()->with('region')->limit(5)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'label' => $item->name,
                'region' => $item->region->name . ' ' . $item->region->country->name,
            ];
        });
    }
}
