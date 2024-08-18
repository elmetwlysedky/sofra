<?php

namespace App\Http\Repositories\Restaurant;

use App\Http\Interfaces\AuthInterface;
use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{

    public function register($request)
    {
        return  Restaurant::create($request);
    }

    public function login($request)
    {
        $credentials=$request->validated();

        if (Auth::guard('restaurant_web')->attempt($credentials)) {
            return Auth::guard('restaurant_web')->user();


        }
    }

    public function logout($request)
    {
        if($request->user()->tokens()) {
            $request->user()->currentAccessToken()->delete();
        }
    }

    public function sendResetLinkEmail($request)
    {

        $client = Restaurant::where('email', $request['email'])->first();
        if ($client) {
            $pin_code = rand(10000, 99999);
            $client->update(['pin_code' => $pin_code]);
//dd($client);
            // send email or message here

            return $pin_code;
        }
    }

    public function reset_password($request)
    {
        $client = Restaurant::where('pin_code', $request->pin_code)
            ->where('email', $request->email)->first();

        if ($client) {
            $client->password = Hash::make($request->password);
            $client->save();
            $client->update(['pin_code'=>null]);
            return $client;
        }
    }


}
