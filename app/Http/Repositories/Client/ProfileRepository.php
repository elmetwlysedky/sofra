<?php

namespace App\Http\Repositories\Client;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProfileRepository implements RepositoryInterface
{

    public function all()
    {
        return Client::all();
    }

    public function show($id): ?Model
    {
        return Client::findOrFail($id);    }

    public function store(array $data): ?Model
    {
        return Client::create($data);
    }

    public function update(array $data ,$id): ?Model
    {
        $client = Auth::guard('client')->user();

        $client = Client::findOrFail($data['id']);
        $client->update($data);
        return $client;
    }

    public function delete($id): bool
    {
       return Client::destroy($id);
    }
}
