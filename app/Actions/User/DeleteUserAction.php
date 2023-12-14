<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUserAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepository $repository
    )
    {
    }

    public function handle(User $user): ?bool
    {
        return $this->repository->delete($user);
    }
}
