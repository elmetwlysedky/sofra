<?php

namespace App\Http\Repositories\Client;

use App\Http\Interfaces\AuthInterface;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{

    public function register($request)
    {
        return  Client::create($request);
    }

    public function login($request)
    {
        $credentials = $request->validated();

        if (Auth::guard('client_web')->attempt($credentials)) {
            return Auth::guard('client_web')->user();
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
        $client = Client::where('email', $request['email'])->first();
        if ($client) {
            $pin_code = rand(10000, 99999);
            $client->update(['pin_code' => $pin_code]);

            // send email or message here

            return $pin_code;
        }
    }

    public function reset_password($request)
    {
        $client = Client::where('pin_code', $request->pin_code)
            ->where('email', $request->email)->first();

        if ($client) {
            $client->password = Hash::make($request->password);
            $client->save();
            $client->update(['pin_code'=>null]);
            return $client;
        }    }


}
