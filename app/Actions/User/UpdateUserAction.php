<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUserAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepository $repository,
    )
    {
    }

    public function handle(User $user, array $payload): User
    {
        return DB::transaction(function () use ($user, $payload) {
            return $this->repository->update(model: $user, payload: $payload);
        });
    }
}
