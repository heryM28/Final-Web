<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id(); // Kolom primary key
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->unsignedBigInteger('book_id'); // Foreign key ke tabel books
            $table->timestamp('loan_date')->useCurrent();
            $table->timestamp('due_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->enum('status', ['borrowed', 'returned', 'extended'])->default('borrowed');
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')
                  ->references('id') // Kolom referensi yang benar di tabel users
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Foreign key ke tabel books
            $table->foreign('book_id')
                  ->references('id') // Kolom referensi yang benar di tabel books
                  ->on('books')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
