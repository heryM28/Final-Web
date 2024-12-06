<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); 
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->year('publication_year');
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            
            // Menambahkan foreign key dengan category_id
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            // Kolom waktu untuk created_at dan updated_at
            $table->timestamps();

            // Kolom untuk status ketersediaan buku
            $table->boolean('is_available')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
