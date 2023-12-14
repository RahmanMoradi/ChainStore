<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUserAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepository $repository
    )
    {
    }

    public function handle(array $payload): User
    {
        return DB::transaction(function () use ($payload) {
            $user = $this->repository->store($payload);
            return $this->repository->verifyUser($user);

        });
    }
}
