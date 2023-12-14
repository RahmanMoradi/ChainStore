<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Category\StoreCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Category::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CategoryRepositoryInterface $categoryRepository): JsonResponse
    {
        return $this->successResponse(
            CategoryResource::collection(
                $categoryRepository->paginate($request->input('page_limit'))
            ),
            trans("category.success_index")
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = StoreCategoryAction::run($request->validated());
        return $this->successResponse(
            CategoryResource::make($category),
            trans("category.success_store")
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        return $this->successResponse(
            CategoryResource::make($category),
            trans("category.success_show"),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $category = UpdateCategoryAction::run($category, $request->validated());
        return $this->successResponse(
            CategoryResource::make($category),
            trans("category.success_update"),
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->successResponse(
            "True",
            trans("category.success_destroy")
        );
    }

}
