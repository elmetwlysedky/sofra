<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Restaurant\OfferRepository;
use App\Http\Requests\OfferRequest;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    use JsonResponseTrait;
    protected $offerRepository;

    public function __construct(OfferRepository $param)
    {
        $this->offerRepository=$param;
    }

    public function all()
    {
        $offers = $this->offerRepository->all();
        return $this->jsonSuccess($offers);
    }

    public function show($id)
    {
        $data = $this->offerRepository->show($id);
        return $this->jsonSuccess($data);

    }

    public function create(OfferRequest $request)
    {
        $restaurant_id = Auth::guard('restaurant')->user()->id;

        $validate = $request->validated();
        if($request->image !=null) {
            $path = $request->file('image')->store('OfferImages');
            $validate['image'] = $path;
        }
        $validate['restaurant_id'] =$restaurant_id;

        $data = $this->offerRepository->store($validate);

        return $this->jsonSuccess($data,'this is offer ');

    }

    public function update(OfferRequest $request,$id)
    {

        $validate = $request->validated();
        if($request->image !=null) {
            $path = $request->file('image')->store('ProductImages');
            $validate['image'] = $path;
        }

        $data = $this->offerRepository->update($validate ,$id);
        return $this->jsonSuccess($data);

    }

    public function delete($id)
    {
        $this->offerRepository->delete($id);
        return $this->jsonSuccess();
    }

}
