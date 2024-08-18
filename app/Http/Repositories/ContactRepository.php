<?php

namespace App\Http\Repositories;

use App\Models\Contact;

class ContactRepository
{

    public function all()
    {
        return Contact::all();

    }

    public function show($id)
    {
        return Contact::findOrFail($id);

    }

    public function store($request)
    {
        return Contact::create($request);

    }

    public function delete($id)
    {
        $contact  = Contact::findOrFail($id);
        return Contact::destroy($contact);

    }
}
