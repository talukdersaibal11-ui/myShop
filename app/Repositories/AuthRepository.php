<?php

namespace App\Repositories;

use App\Models\User;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function login($request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user){
            throw new CustomException("User Not Found");
        }

        if(!$user->is_verified){
            throw new CustomException("User Account not verified.");
        }

        if (Hash::check($request->password, $user->password)) {
            $token =  $user->createToken("auth_token")->plainTextToken;

            $data = [
                "user"  => $user,
                "token" => $token
            ];
            return $data;
        }


        throw new CustomException("User credential doesn't match");
    }
}
