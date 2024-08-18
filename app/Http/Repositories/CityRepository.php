<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\City;
use Illuminate\Database\Eloquent\Model;

class CityRepository implements RepositoryInterface
{

    public function all()
    {
        return City::all();
    }

    public function show($id): ?Model
    {
        return City::findOrFail($id);
    }

    public function store(array $data): ?Model
    {
        return City::create($data);
    }

    public function update(array $data, $id): ?Model
    {
        $city = City::findOrFail($id);
        $city->update($data);
        return $city;
    }

    public function delete($id): bool
    {
        return City::destroy($id);
    }
}
