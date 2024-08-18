<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Repositories\OrderRepository;
use App\Http\Requests\OrderRequest;
use App\Models\Product;
use App\Models\Restaurant;
use App\Settings\AccountSetting;
use App\Traits\JsonResponseTrait;


class OrderController extends Controller
{
    use JsonResponseTrait;

    protected $orderRepository ,
              $commission;

    public function __construct(OrderRepository $param,
                                    AccountSetting $commission)
    {
        $this->orderRepository=$param;
        $this->commission =$commission->commission;
    }

    public function create(OrderRequest $request)
    {
        $data = $request->validated();
        $data['status']= 'pending';

         $order = $this->orderRepository->store($data);
         $this->calculate_items($request->items ,$order);
//        dd($data);

         $order_data = $order->fresh()->load('products');
        return $this->jsonSuccess($order_data ,'تم ارسال الطلب');

    }
    public function calculate_items($items ,$order)
    {

        $order_price = 0;
        foreach ($items as $item)
        {
            $product = Product::find($item['product_id']);
            $one_item =[
                $item['product_id']=>[
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'special' => $item['special'] ?? ''
                ]
            ];

            $order->products()->attach($one_item);
            $order_price += $product->price * $item['quantity'];
        }
        $restaurant = Restaurant::find($order['restaurant_id']);
        $delivery_charge = $restaurant->delivery_charge;
        $minimum_order = $restaurant->minimum_order;
        if($order_price >= $minimum_order)
        {
            $total_price = $order_price + $delivery_charge;
            $commission = $this->commission * $total_price/100;

            $update = $order->update([
               'delivery_charge' => $delivery_charge,
                'total_price' => $total_price,
                'commission' => $commission
            ]);
        }

    }

    public function show($id)
    {
        $data = $this->orederRepository->show($id);
        return $this->jsonSuccess($data);
    }


    public function details($id)
    {
        $data = $this->orederRepository->show($id);
        return $this->jsonSuccess($data);
    }

    public function current()
    {
        $order = $this->orderRepository->current();
        return $this->jsonSuccess($order);
    }

    public function pending()
    {
        $order = $this->orderRepository->pending();
        return $this->jsonSuccess($order);
    }

    public function previous()
    {
        $order = $this->orderRepository->previous();
        return $this->jsonSuccess($order);
    }

}
