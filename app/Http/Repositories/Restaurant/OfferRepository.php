<?php

namespace App\Http\Repositories\Restaurant;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Model;

class OfferRepository implements RepositoryInterface
{

    public function all()
    {
        return Offer::all();

    }

    public function show($id): ?Offer
    {
        return Offer::findOrFail($id);
    }

    public function store(array $data): ?Offer
    {
        return Offer::create($data);
    }

    public function update(array $data,$id): ?Offer
    {
        $offer = Offer::findOrFail($id);
        $offer->update($data);
        return $offer;
    }

    public function delete($id): bool
    {
        return Offer::destroy($id);
    }
}
