<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCategoryAction
{
    use AsAction;

    public function __construct(
        private readonly CategoryRepositoryInterface $repository,
    )
    {
    }

    public function handle(Category $category, array $payload): Category
    {
        return DB::transaction(function () use ($category, $payload) {
            return $this->repository->update(model: $category, payload: $payload);
        });
    }
}
