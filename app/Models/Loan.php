<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'book_id',
        'loan_date',
        'due_date',
        'return_date',
        'status',
    ];


    // Laravel 8 dan sebelumnya: Gunakan $dates
    protected $dates = ['loan_date', 'due_date', 'return_date'];

    // Laravel 9+
    protected $casts = [
        'loan_date' => 'datetime',
        'due_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    // public function fines()
    // {
    //     return $this->hasMany(Fine::class);
    // }

    public function fines()
    {
        return $this->hasOne(Fine::class);
    }
}
