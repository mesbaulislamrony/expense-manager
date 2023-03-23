<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LoggedUserScopeTrait;
use App\Models\User;

class Expense extends Model
{
    use HasFactory, LoggedUserScopeTrait;

    protected $fillable = ['user_id', 'expense_category_id', 'date', 'amount'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
