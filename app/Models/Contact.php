<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;

    // Properti opsional untuk tabel. Jika tabel Anda bernama `contacts`, Anda tidak perlu mendefinisikan ini.
    // protected $table = 'contacts';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
