<?php

namespace App\Http\Repositories\Restaurant;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements RepositoryInterface
{

    public function all()
    {
        return Product::all();

    }

    public function show($id): ?Product
    {
       return Product::findOrFail($id);
    }

    public function store(array $data): ?Product
    {
        return Product::create($data);
    }

    public function update(array $data,$id): ?Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id): bool
    {
        return Product::destroy($id);
    }
}
