<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExpenseCategoryRequest;
use App\Models\ExpenseCategory;
use App\Http\Resources\ExpenseCategoryResource;
use PDOException;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ExpenseCategory::orderBy('id', 'desc')->get();
        return response()->json(['data' => ExpenseCategoryResource::collection($categories)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseCategoryRequest $request)
    {
        $validated = array_merge([
            'user_id' => auth()->user()->id
        ], $request->validated());
        
        $category = ExpenseCategory::create($validated);
        return response()->json(['data' => new ExpenseCategoryResource($category)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseCategory $category)
    {
        return response()->json(['data' => new ExpenseCategoryResource($category)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseCategoryRequest $request, ExpenseCategory $category)
    {
        $category->update($request->validated());
        return response()->json(['data' => new ExpenseCategoryResource($category)], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseCategory $category)
    {
        $category->delete();
        return response()->json(['data' => null], 204);
    }
}
