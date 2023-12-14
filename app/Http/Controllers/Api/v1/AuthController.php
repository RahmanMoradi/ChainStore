<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\User\StoreUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function register(RegisterRequest $request)
    {
        $user = StoreUserAction::run($request->validated());
        return $this->successResponse(
            UserResource::make($user),
            trans("user.success_register")
        );
    }


    public function login(LoginRequest $request, UserRepositoryInterface $userRepository)
    {
        if(Auth::attempt($request->validated())){
            $user = Auth::user();
            $token = $userRepository->generateToken($user);
            return $this->successResponse([
                'token' => $token,
                'user'  => UserResource::make($user)
            ], trans('user.success_login'));
        }
        return $this->errorResponse(trans('user.failed_login'), 404);
    }

    public function logout(Request $request)
    {
        Auth::user()->delete();
        return $this->successResponse(
            true,
            trans("user.success_delete"),
        );
    }
}
