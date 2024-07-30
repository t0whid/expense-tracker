<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'amount', 'category_id', 'note', 'date', 'expense_by', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'date' => 'datetime',
    ];
}
