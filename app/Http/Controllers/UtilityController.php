<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Expense;

class UtilityController extends Controller
{
    public function summary()
    {
        $total_expense = Expense::sum('amount');
        
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expenses.expense_category_id')
        ->select('expense_categories.name', DB::raw('SUM(amount) as amount'))
        ->groupBy('expense_categories.name')
        ->orderByRaw('amount desc')
        ->get();

        $expenses->map(function($expense) use ($total_expense){
            $expense->percentage = round((($expense->amount/$total_expense)*100), 0);
            return $expense;
        });
        
        return response()->json(['data' => [
            'total_amount' => $total_expense,
            'top_expenses' => $expenses
        ]], 200);
    }
}
