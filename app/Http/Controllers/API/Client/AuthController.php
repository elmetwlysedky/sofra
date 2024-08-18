<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Client\AuthRepository;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResestPasswordRequest;
use App\Http\Requests\SendEmailRequest;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use JsonResponseTrait;
    protected $authRepository;

    public function __construct(AuthRepository $param)
    {
        $this->authRepository=$param;
    }

    public function register(ClientRequest $request)
    {
        $data = $request->validated();
        $data['password']= bcrypt($request->password);
//        dd($data);

        $client = $this->authRepository->register($data);
        $token = $client->createToken('ClientToken')->plainTextToken;

        return $this->jsonSuccess([$data,'token'=>$token]);
    }

    public function login(LoginRequest $request)
    {
        $data= $this->authRepository->login($request);

        if($data){
            $token = $data->createToken('restaurantToken')->plainTextToken;

            return $this->jsonSuccess([$data,'token'=>$token]);
        }
        return $this->jsonFailed([ 'this email or password is not invalid']);

    }
    public  function logout(Request $request)
    {
        $this->authRepository->logout($request);
        return $this->jsonSuccess('', 'logout successfully');
    }

    public function sendResetLinkEmail(SendEmailRequest $request)
    {

        $data= $request->validated();
        $pin_code = $this->authRepository->sendResetLinkEmail($data);

        if($pin_code) {
            return $this->jsonSuccess($pin_code);
        } else {
            return $this->jsonFailed([null ,'this email is not define']);
        }
    }

    public function reset_password(ResestPasswordRequest $request)
    {
        $data = $this->authRepository->reset_password($request);
        if ($data) {
            return $this->jsonSuccess($data);
        } else {
            return $this->jsonFailed();
        }
    }
}
