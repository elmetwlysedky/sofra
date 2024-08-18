<?php

namespace App\Http\Controllers\Dashboard\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Restaurant\ProfileRepository;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    protected $profileRepository;

    public function __construct(ProfileRepository $param)
    {
        $this->profileRepository=$param;
    }

    public function all(Request $request)
    {
        return view('Dashboard.Restaurant.index',[
            'restaurants' => $this->profileRepository->all_with_filter($request)
        ]);
    }

    public function show($id)
    {

        return view('Dashboard.restaurant.show',[
            'restaurant'=> $this->profileRepository->show($id)
        ]);
    }

    public function products($id)
    {
        return view('Dashboard.Restaurant.products',[
            'products' => Product::where('restaurant_id',$id)->get()
        ]);

    }

    public function orders($id)
    {
        return view('Dashboard.restaurant.orders',[
            'orders' => Order::where('restaurant_id',$id)
                ->get()
        ]);

    }


    public function active(Request $request , $id)
    {
        $this->profileRepository->active($request,$id);
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = $this->profileRepository->delete($id);
        session()->flash('delete', __('main.deleted_success'));
        return redirect()->back();
    }
}
