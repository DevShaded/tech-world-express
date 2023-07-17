<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Categories/Index', [
            'data' => [
                'categories' => CategoryService::getAllCategories() ?? null,
            ],
        ]);
    }

    public function show(string $name): Response
    {
        return Inertia::render('Categories/Show', [
            'data' => [
                'products' => CategoryService::getCategoryWithProducts($name) ?? null,
                'category' => CategoryService::getCategoryByName($name) ?? null,
            ],
        ]);
    }
}
