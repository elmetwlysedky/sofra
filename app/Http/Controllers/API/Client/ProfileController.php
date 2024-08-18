<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Client\ProfileRepository;
use App\Http\Requests\ClientProfileRequest;
use App\Models\Client;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use JsonResponseTrait;
    protected $profileRepository;

    public function __construct(ProfileRepository $param)
    {
        $this->profileRepository=$param;
    }

    public function all()
    {
        $data = $this->profileRepository->all();
        return $this->jsonSuccess($data);
    }

    public function update(ClientProfileRequest $request )
    {

        $data = $request->validated();

        if ($request->password != null) {
            $data['password'] = bcrypt($request->password);
        }

        $client = $this->profileRepository->update($data);

        return $this->jsonSuccess($client);
    }

    public function show($id)
    {
        $data = $this->profileRepository->show($id);
        return $this->jsonSuccess($data);
    }

    public function delete($id)
    {
        $this->profileRepository->delete($id);
        return $this->jsonSuccess();
    }

}
