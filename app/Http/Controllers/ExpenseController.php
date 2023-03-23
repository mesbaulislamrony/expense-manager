<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use PDOException;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('category', 'user')->where(['date' => Carbon::today()->format('Y-m-d')])->orderBy('id', 'desc')->get();
        return response()->json(['data' => ExpenseResource::collection($expenses)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $validated = array_merge([
            'user_id' => auth()->user()->id,
            'date' => Carbon::today()->format('Y-m-d'),
        ], $request->validated());
        
        $expense = Expense::create($validated);
        return response()->json(['data' => new ExpenseResource($expense)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return response()->json(['data' => new ExpenseResource($expense)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        return response()->json(['data' => new ExpenseResource($expense)], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json(['data' => $expense], 204);
    }
}
