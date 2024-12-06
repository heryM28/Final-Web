<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    // Menentukan kolom mana yang dapat diisi (mass assignable)
    protected $fillable = [
        'title', 
        'author', 
        'publisher', 
        'publication_year', 
        'stock', 
        'description', 
        'category_id', 
        'is_available',
    ];

    /**
     * Relasi dengan model Category
     * Setiap buku dimiliki oleh satu kategori
     */
    public function category()
    {
        // Menentukan foreign key yang digunakan oleh relasi
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeNotAvailable($query)
    {
        return $query->where('is_available', false);
    }

     // Relasi ke model Loan
     public function loans()
     {
         return $this->hasMany(Loan::class);
     }
}
