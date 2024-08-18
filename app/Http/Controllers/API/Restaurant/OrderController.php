<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\OrderRepository;
use App\Http\Requests\StatusOrderRequest;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Token;
use App\Traits\FcmTrait;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use JsonResponseTrait;
    use FcmTrait;
    protected $orderRepository ;


    public function __construct(OrderRepository $param)

    {
        $this->orderRepository=$param;
    }

    public function status(StatusOrderRequest $request,$id)
    {
        $validate = $request->validated();
        $order = $this->orderRepository->update($validate,$id);

        $notification_data = [
            'title' => ' تم تحديث حاله طلبك ',
            'content' => ' تم تحديث حاله طلبك الان  '. $order->status,
            'order_id' => $order->id,
            'client_id' => $order->client_id,
            'restaurant_id' => $order->restaurant_id];

        $notification = Notification::create($notification_data);
        $tokens = Token::whereHas('client', function ($query) use ($order) {

                $query->where('client_id', $order->client_id);

        })->where('token', '!=', null)->pluck('token')->toArray();

//        dd($tokens);

        if (count($tokens)) {
            $title = $notification->title;
            $body = $notification->content;
            $data = [
                'donation_request_id' => $order->id
            ];
            $send = $this->notifyByFirebase($title, $body, $tokens, $data);
            info("firebase result: " . $send);

//             dd(env('FIREBASE_API_ACCESS_KEY'));
//            dd($send);
            return $this->jsonSuccess($order);
        }
    }

    public function current()
    {
        $restaurant = Auth::guard('restaurant')->id();

        $order = $this->orderRepository->current()->where('restaurant_id',$restaurant);
        return $this->jsonSuccess($order);
    }

    public function pending()
    {
        $restaurant = Auth::guard('restaurant')->id();

        $order = $this->orderRepository->pending()->where('restaurant_id',$restaurant);
        return $this->jsonSuccess($order);
    }


    public function previous()
    {
        $restaurant = Auth::guard('restaurant')->id();

        $order = $this->orderRepository->previous()->where('restaurant_id',$restaurant);
        return $this->jsonSuccess($order);
    }


}
