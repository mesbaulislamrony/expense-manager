<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LoggedUserScopeTrait;

class ExpenseCategory extends Model
{
    use HasFactory, LoggedUserScopeTrait;

    protected $fillable = ['user_id', 'name', 'url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
