<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CategoryService::getAllCategories();
    }

    public function show(string $name): AnonymousResourceCollection
    {
        return CategoryService::getCategoryWithProjects($name);
    }
}
