<?php

namespace App\Http\Controllers\Category;

use App\Actions\Category\GetAllCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = GetAllCategoryAction::run();

        return CategoryResource::collection($categories);
    }
}
