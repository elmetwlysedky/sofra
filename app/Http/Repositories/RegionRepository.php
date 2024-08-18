<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;

class RegionRepository implements RepositoryInterface
{

    public function all()
    {
        return Region::all();
    }

    public function show($id): ?Model
    {
        return Region::findOrFail($id);
    }

    public function store(array $data): ?Model
    {
        return Region::create($data);
    }

    public function update(array $data, $id): ?Model
    {
        $city = Region::findOrFail($id);
        $city->update($data);
        return $city;
    }

    public function delete($id): bool
    {
        return Region::destroy($id);
    }
}
