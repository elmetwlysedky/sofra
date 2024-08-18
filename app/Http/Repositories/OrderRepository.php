<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements RepositoryInterface
{

    public function all()
    {
        return Order::all();
    }
    public function index($request)
    {
        $restaurantName = $request->input('restaurant_name');

        $orders = Order::whereHas('restaurant', function($query) use ($restaurantName) {
            $query->where('name', 'like', '%' . $restaurantName . '%');
        })->get();

        return $orders;
    }


    public function show($id): ?Model
    {
        return  Order::with('products')->find($id);

    }

    public function store(array $data): ?Model
    {
        return Order::create($data);
    }

    public function update(array $data, $id): ?Model
    {
        $order = Order::findOrFail($id);
        $order->update($data);
        return $order;
    }

    public function delete($id): bool
    {
        // TODO: Implement delete() method.
    }

    public function current()
    {
        return Order::where('status','preparation')->get();

    }
    public function pending()
    {
        return Order::where('status','pending')->get();

    }
    public function previous()
    {
        return Order::where('status','accept')->get();

    }


}
