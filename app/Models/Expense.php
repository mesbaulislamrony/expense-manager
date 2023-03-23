<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LoggedUserScopeTrait;

class Expense extends Model
{
    use HasFactory, LoggedUserScopeTrait;

    protected $fillable = ['user_id', 'expense_category_id', 'amount'];
}
