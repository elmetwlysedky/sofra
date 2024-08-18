<?php

namespace App\Http\Repositories\Restaurant;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\Restaurant;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProfileRepository implements RepositoryInterface
{

    public function all()
    {
       return Restaurant::all();
    }

    public function all_with_filter($request)
    {
        $city = $request->city;
        $name = $request->name;

        $restaurant = Restaurant::with('region.city')
            ->when($city, function ($query) use ($city) {
                $query->whereHas('region.city', function ($query) use ($city) {
                    $query->where('id', $city);
                });
                    })
            ->when($name, function ($query) use ($name) {
                return $query->where('name', 'like', '%' . $name . '%');

        })->get();
        return $restaurant;
    }

    public function show($id): ?Model
    {
        return Restaurant::findOrFail($id);

    }

    public function store(array $data): ?Model
    {
        return Restaurant::create($data);
    }

    public function update(array $data ,$id): ?Model
    {
        $restaurant = Auth::guard('restaurant')->user();
         $restaurant->update($data);
        return $restaurant;
    }

    public function delete($id): bool
    {
       $restaurant = Restaurant::findOrFail($id);
       return $restaurant->destroy($id);

    }

    public function active($request ,$id)
    {

        $status = Restaurant::findOrFail($id);

        $validatedData = $request->validate([
            'is_active' => 'required'
        ]);

        $status->is_active = $validatedData['is_active'];
        $status->save();
    }
}
