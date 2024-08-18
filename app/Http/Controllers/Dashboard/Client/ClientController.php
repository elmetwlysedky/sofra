<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Client\ProfileRepository;
use App\Models\Order;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $profileRepository;

    public function __construct(ProfileRepository $param)
    {
        $this->profileRepository=$param;
    }

    public function all()
    {
        return view('Dashboard.Client.index',[
            'clients' => $this->profileRepository->all()
        ]);
    }

    public function show($id)
    {

        return view('Dashboard.restaurant.show',[
            'client'=> $this->profileRepository->show($id)
        ]);
    }

    public function orders($id)
    {
        return view('Dashboard.Client.orders',[
            'orders' => Order::where('client_id',$id)
                ->get()
        ]);

    }

    public function delete($id)
    {
        $data = $this->profileRepository->delete($id);
        session()->flash('delete', __('main.deleted_success'));
        return redirect()->back();
    }
}
