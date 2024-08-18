<?php

namespace App\Http\Repositories\Client;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;

class ReviewRepository implements RepositoryInterface
{

    public function all()
    {
       return Review::all();
    }

    public function show($id): ?Model
    {
        return  Review::find($id);

    }

    public function restaurant($id)
    {
        $restaurant = Restaurant::find($id);
        return  Review::where('restaurant_id',$id)->get();

    }
    public function store(array $data): ?Model
    {
        return Review::create($data);
    }

    public function update(array $data, $id): ?Model
    {
        // TODO: Implement update() method.
    }

    public function delete($id): bool
    {
        // TODO: Implement delete() method.
    }
}
