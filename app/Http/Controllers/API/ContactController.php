<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ContactRepository;
use App\Http\Requests\ContactRequest;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use JsonResponseTrait;
    protected $contactRepository;

    public function __construct(ContactRepository $param)
    {
        $this->contactRepository=$param;
    }

    public function store(ContactRequest $request)
    {
        $validate = $request->validated();
        $data = $this->contactRepository->store($validate);
        return $this->jsonSuccess($data);
    }

    public function all()
    {
        return view('Dashboard.Contact.index',[
            'contacts'=> $this->contactRepository->all()

        ]);
    }

    public function show($id)
    {
        return view('Dashboard.Contact.show',[
        'contact'=> $this->contactRepository->show($id)

        ]);
    }

    public function delete($id)
    {
        $data = $this->contactRepository->delete($id);
        return $this->jsonSuccess($data);
    }
}
