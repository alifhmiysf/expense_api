<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::whereNull('user_id')
        ->orWhere('user_id', $request->user()->id)
        ->get();

        return response()->json([
            'data' => $categories
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $request->user()->categories()->create($request->validated());

        return response()->json([
            'message' =>'Category created successfully',
            'data' => $category
        ], 201);
    }

    public function show(Category $category){
        if($category->user_id !== null && $category->user_id !== request()->user()->id){
            abort(403, 'Unauthorized action.');
        }
        return response()->json(['data' => $category]);
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        if($category->user_id !== $request->user()->id){
            abort(403, 'You can only edit your own categories');
        }

        $category->update($request->validated());
        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    public function destroy(Category $category)
    {
        if ($category->user_id !== request()->user()->id){
            abort(403, 'You can only delete ypur own categories');
        }

        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }

}
