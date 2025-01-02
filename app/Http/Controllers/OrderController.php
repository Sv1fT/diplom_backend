<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sortBy = \request('sortBy') ?? collect();
        $filters = \request('filters') ?? collect();

        $query = Order::query()->with('city_from','user', 'city_to');

        foreach ($request->except('page') as $key => $value) {
            if(!$value) continue;

            if($key == 'to_city_id') {
                $query->where($key, '=', $value['id']);
            }
            elseif($key == 'datetime_to') {
                $query->where($key, '<=', $value);
            }
            elseif($key == 'datetime_from') {
                $query->where($key, '>=', $value);
            }
            elseif($key == 'from_city_id') {
                $query->where($key, '=', $value['id']);
            }
            else {
                $query->where($key, $value);
            }
        }

        foreach ($sortBy as $key => $value) {
            $query->orderBy($key, $value);
        }

        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }

        return $query->paginate();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->id = Str::uuid();
        $order->from_city_id = $request->get('city_from')['id'];
        $order->to_city_id = $request->get('city_to')['id'];
        $order->datetime_from = $request->get('date_from');
        $order->datetime_to = $request->get('date_to');
        $order->weight = $request->get('weight');
        $order->price = $request->get('price');
        $order->order_number = Str::random();
        $order->active = 0;
        $order->user_id = $request->user('sanctum')->id;

        if($order->save()){
            return response()->json([]);
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function filters()
    {
        $orders = Order::query()->get();

        dd();
    }
}
