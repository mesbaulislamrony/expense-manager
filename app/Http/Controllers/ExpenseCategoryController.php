<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExpenseCategoryRequest;
use App\Models\ExpenseCategory;
use PDOException;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ExpenseCategory::orderBy('id', 'desc')->get();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseCategoryRequest $request)
    {
        $validated = array_merge(['user_id' => auth()->user()->id], $request->validated());

        try {
            $category = ExpenseCategory::create($validated);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully',
                'category' => $category
            ], 200);

        } catch (PDOException $e) {
            dd($e);
            return response()->json(['status' => 'error', 'message' => 'Category create failed'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = ExpenseCategory::find($id);

        if(!$category)
        {
            return response()->json(['status' => 'error', 'message' => 'Category not found'], 400);
        }

        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseCategoryRequest $request, $id)
    {
        $category = ExpenseCategory::find($id);

        if(!$category)
        {
            return response()->json(['status' => 'error', 'message' => 'Category not found'], 400);
        }

        try {

            $category->update($request->validated());
            
            return response()->json([
                'status' => 'success',
                'message' => 'Category update successfully',
                'category' => $category
            ], 200);

        } catch (PDOException $e) {
            dd($e);
            return response()->json(['status' => 'error', 'message' => 'Category update failed'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = ExpenseCategory::find($id);

        if(!$category)
        {
            return response()->json(['status' => 'error', 'message' => 'Category not found'], 400);
        }

        try {

            $category->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Category delete successfully',
            ], 200);

        } catch (PDOException $e) {
            dd($e);
            return response()->json(['status' => 'error', 'message' => 'Category delete failed'], 400);
        }
    }
}
