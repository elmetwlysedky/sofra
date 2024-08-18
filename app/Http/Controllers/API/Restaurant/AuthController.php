<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Restaurant\AuthRepository;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResestPasswordRequest;
use App\Http\Requests\RestaurantRequest;
use App\Http\Requests\SendEmailRequest;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    use JsonResponseTrait;
    protected $authRepository;

    public function __construct(AuthRepository $param)
    {
        $this->authRepository=$param;
    }

    public function register(RestaurantRequest $request)
    {
        $data = $request->validated();

        if($request->image !=null){
            $path = $request->file('image')->store('ProfileImages');
            $data['image']=$path;
        }

        $data['password']= bcrypt($request->password);

        $restaurant = $this->authRepository->register($data);
        $token = $restaurant->createToken('restaurantToken')->plainTextToken;


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
