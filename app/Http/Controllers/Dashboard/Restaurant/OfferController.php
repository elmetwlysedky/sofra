<?php

namespace App\Http\Controllers\Dashboard\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Restaurant\OfferRepository;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    protected $offer;

    public function __construct(OfferRepository $param)
    {
        $this->offer =$param;
    }

    public function index()
    {
        
        return view('Dashboard.Offer.index',[
            'offers' => $this->offer->all()
        ]);
    }

    public function delete($id)
    {
        $this->offer->delete($id);
        session()->flash('success',__('main.deleted_success'));
        return redirect()->route('offer.index');
    }
}
