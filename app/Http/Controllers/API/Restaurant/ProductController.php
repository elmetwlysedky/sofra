<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Restaurant\ProductRepository;
use App\Http\Requests\ProductRequest;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use JsonResponseTrait;
    protected $productRepository;

    public function __construct(ProductRepository $param)
    {
        $this->productRepository = $param;

    }

    public function all()
    {

        $data = $this->productRepository->all();
        return $this->jsonSuccess($data);

    }

    public function show($id)
    {
        $data = $this->productRepository->show($id);
        return $this->jsonSuccess($data);

    }

    public function store(ProductRequest $request)
    {
        $validate = $request->validated();

        if($request->image !=null) {
            $path = $request->file('image')->store('ProductImages');
            $validate['image'] = $path;
        }
        $data = $this->productRepository->store($validate);
        return $this->jsonSuccess($data);
    }

    public function update(ProductRequest $request,$id)
    {
        $validate = $request->validated();
        if($request->image !=null) {
            $path = $request->file('image')->store('ProductImages');
            $validate['image'] = $path;
        }
        $data = $this->productRepository->update($validate ,$id);
        return $this->jsonSuccess($data);

    }

    public function delete($id)
    {
        $this->productRepository->delete($id);
        return $this->jsonSuccess();
    }
}
