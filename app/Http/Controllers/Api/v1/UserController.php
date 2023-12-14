<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserRepositoryInterface $userRepository): JsonResponse
    {
        return $this->successResponse(
            UserResource::collection(
                $userRepository->paginate($request->input('page_limit'))
            ),
            trans("user.success_index")
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        return $this->successResponse(
            UserResource::make(
                StoreUserAction::run($request->validated())
            ),
            trans("user.success_store"),
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return $this->successResponse(
            UserResource::make($user),
            trans("user.success_show"),
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user = UpdateUserAction::run($user, $request->validated());
        return $this->successResponse(
            UserResource::make($user),
            trans("user.success_update"),
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return $this->successResponse(
            "True",
            trans("user.success_destroy"),
        );
    }

    public function forceDelete(User $user)
    {
        $user->forceDelete();
        return $this->successResponse(
            "True",
            trans("user.success_force_delete")
        );
    }

    public function restore(User $user)
    {
        $user->restore();
        return $this->successResponse(
            "True",
            trans("user.success_restore")
        );
    }
}
