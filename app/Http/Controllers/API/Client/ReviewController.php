<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Client\ReviewRepository;
use App\Http\Requests\ReviewRequest;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use JsonResponseTrait;
    protected $reviewRepository;

    public function __construct(ReviewRepository $param)
    {
        $this->reviewRepository=$param;
    }


    public function store(ReviewRequest $request)
    {
        $validate = $request->validated();
        $data = $this->reviewRepository->store($validate);
        return $this->jsonSuccess($data);

    }

    public function show($id)
    {
        $data = $this->reviewRepository->show($id);
        return $this->jsonSuccess($data);
    }

    public function restaurant($id)
    {
        $data = $this->reviewRepository->restaurant($id);
        return $this->jsonSuccess($data);
    }
}
