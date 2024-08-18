<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderRepository $param)
    {
        $this->order = $param;
    }

    public function index(Request $request)
    {
        return view('Dashboard.Order.index',[
            'orders' => $this->order->index($request)
        ]);
    }
    public function current()
    {
        return view('Dashboard.Order.index',[
            'orders' => $this->order->current()
        ]);
    }

    public function pending()
    {
        return view('Dashboard.Order.index',[
            'orders' => $this->order->pending()
        ]);
    }

    public function previous()
    {
        return view('Dashboard.Order.index',[
            'orders' => $this->order->previous()
        ]);
    }

    public function show($id)
    {

        return view('Dashboard.Order.show',[
            'order' => $this->order->show($id)
        ]);
    }

    public function print($id)
    {
        return view('Dashboard.Order.print_invoice',[
            'order' => $this->order->show($id)
        ]);
    }
}
