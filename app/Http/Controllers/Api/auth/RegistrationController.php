<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function registration(Request $request){
        $validatedData = $request->validate([
            'firstname' =>'required',
            'lastname' =>'required|string|max:50',
            'email' =>'required|email|max:100',
            'phone' =>'required|max:100',
            'dob' =>'required|date',
            'city_id' => 'required|integer|exists:cities,id',
            'country_id' => 'required|integer|exists:countries,id',
            'gender' => 'required|in:male,female,others',
            'passport_number' => 'integer|unique:users,passport_number',
            'passport_expiry_date' => 'date',
            'dial_code' => 'required|string|max:10',
            'password' => 'required|string|confirmed',
        ]);


        $user = User::create($validatedData);

        $token = $user->createToken('myusertoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
