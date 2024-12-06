<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $primaryKey = 'fine_id';

    protected $fillable = [
        'loan_id',
        'amount',
        'status',
        'user_id'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
