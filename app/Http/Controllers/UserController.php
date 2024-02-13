<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(RegisterStoreRequest $request)
    {
        $payload = $request->validated();
        try {
            $user = User::create($payload);
        } catch (QueryException) {
            throw UserException::create();
        }
        $collect = collect(new UserResource($user));

        $merge = $collect->merge([
            "token" => $user->createToken("sampleToken")->plainTextToken
        ]);
        $data = [
            "data" => $merge
        ];
        return $data;
    }
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $payload = $request->validated();

        $user = User::where("email", $payload["email"])->first();

        $collect = collect(new UserResource($user));

        $merge = $collect->merge([
            "token" => $user->createToken("sampleToken")->plainTextToken
        ]);
        $data = [
            "data" => $merge
        ];
        return $data;
    }
}
