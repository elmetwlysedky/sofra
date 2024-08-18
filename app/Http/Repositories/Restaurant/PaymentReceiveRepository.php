<?php

namespace App\Http\Repositories\Restaurant;

use App\Http\Interfaces\RepositoryInterface;
use App\Models\PaymentReceive;
use Illuminate\Database\Eloquent\Model;

class PaymentReceiveRepository implements RepositoryInterface
{

    public function all()
    {
        return PaymentReceive::all();
    }

    public function show($id): ?Model
    {
        return PaymentReceive::findOrFail($id);
    }

    public function store(array $data): ?Model
    {
        return PaymentReceive::create($data);
    }

    public function update(array $data, $id): ?Model
    {
       $payment = PaymentReceive::findOrFail($id);
       $payment->update($data);
       return $payment;
    }

    public function delete($id): bool
    {
        return PaymentReceive::destroy($id);
    }
}
