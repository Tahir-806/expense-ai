<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // Table ka naam agar 'expenses' hai to yeh likhna optional hai
    protected $table = 'expenses';

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'user_id',
        'title',
        'amount',
        'category_id',
        'date',
    ];

    // Agar tum date fields ko Carbon instance banana chahte ho
    protected $dates = ['date'];

    // Relation: Expense belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}

}
