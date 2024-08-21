<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    function signIn(SignInRequest $request): \Illuminate\Http\JsonResponse
    {
        if ($request->validated()) {
            $user = User::findByEmail(request('email'));
            if ($user == null) return response()->json([
                "status" => "error",
                "data" => "cant find the user"
            ], ResponseAlias::HTTP_BAD_REQUEST);
            if (Hash::check(request('password'), $user->password)) {
                return response()->json([
                    "status" => "success",
                    "data" => $user
                ], ResponseAlias::HTTP_OK);
            }
            return response()->json([
                "status" => "error",
                "data" => "password is wrong"
            ], ResponseAlias::HTTP_BAD_REQUEST);
        } else return response()->json([
            "status" => "error",
            "data" => "Invalid credentials"
        ], ResponseAlias::HTTP_BAD_REQUEST);
    }

    function signUp(SignUpRequest $request): \Illuminate\Http\JsonResponse
    {
        if ($request->validated()) {
            $data = request(['name', 'email', 'password', 'mobile', 'categories_id']);
            $data["password"] = Hash::make($data["password"]);
            $user = new User($data);
            $user->save();
            return response()->json($user, ResponseAlias::HTTP_CREATED);
        } else return response()->json([
            "status" => "error",
            "data" => "i dont know how it dont here"
        ], ResponseAlias::HTTP_BAD_REQUEST);
    }
}
