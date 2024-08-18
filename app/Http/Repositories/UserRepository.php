<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements RepositoryInterface
{

    public function all()
    {
        return  User::latest()->paginate(10);
    }

    public function show($id): ?Model
    {
        return User::findOrFail($id);
    }

    public function store(array $data): ?Model
    {
        return User::create($data);
    }

    public function update(array $data, $id): ?Model
    {
        $user = User::findOrFail($id);
//        dd($data);
        $user->update($data);

        //        dd($user);

        return $user;
    }

    public function delete($id): bool
    {
       return  User::destroy($id);
    }
}
