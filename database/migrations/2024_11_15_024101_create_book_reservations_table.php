<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookReservationsTable extends Migration
{
   public function up()
   {
       Schema::create('book_reservations', function (Blueprint $table) {
           $table->id('reservation_id');
           $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('book_id');
           $table->timestamp('reservation_date')->useCurrent();
           $table->timestamp('expiry_date')->nullable();
           $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
           $table->text('notes')->nullable();
           $table->timestamps();

           // Foreign keys
           $table->foreign('user_id')
                 ->references('id')
                 ->on('users')
                 ->onDelete('cascade')
                 ->onUpdate('cascade');

           $table->foreign('book_id')
                 ->references('id')
                 ->on('books')
                 ->onDelete('cascade')
                 ->onUpdate('cascade');
       });
   }

   public function down()
   {
       Schema::dropIfExists('book_reservations');
   }
}
