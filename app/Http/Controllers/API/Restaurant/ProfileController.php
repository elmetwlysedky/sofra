<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Restaurant\ProfileRepository;
use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use JsonResponseTrait;
    protected $profileRepository;

    public function __construct(ProfileRepository $param)
    {
        $this->profileRepository=$param;
    }

    public function all(Request $request)
    {
        $data = $this->profileRepository->all_with_filter($request);
        return $this->jsonSuccess($data);
    }



    public function update(RestaurantRequest $request )
    {
        $data = $request->validated();
        if($request->image !=null){
            $path = $request->file('image')->store('ProfileImages');
            $data['image']=$path;
        }
        if ($request->password !=null ){
            $data['password']= bcrypt($request->password);
        }

        $restaurant = $this->profileRepository->update($data);

        return $this->jsonSuccess($restaurant);

    }
    public function show($id)
    {
//         $this->profileRepository->show($id);
$data = Restaurant::findOrFail($id);
       if (! $data) {
           return $this->jsonFailed('this profile is not found');

       }else{
           return $this->jsonSuccess($data);
       }
    }
    public function delete($id)
    {
        $this->profileRepository->delete($id);
        return $this->jsonSuccess();
    }
}
