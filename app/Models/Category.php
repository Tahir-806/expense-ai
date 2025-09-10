<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'type', // optional: use for 'income' or 'expense' if you want
    ];

public function incomes()
{
    return $this->hasMany(Income::class);
}
}

