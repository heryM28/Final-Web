<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration
{
   public function up()
   {
       Schema::create('fines', function (Blueprint $table) {
           $table->id('fine_id');
           $table->unsignedBigInteger('loan_id');
           $table->unsignedBigInteger('user_id');
           $table->decimal('amount', 10, 2);
           $table->enum('status', ['pending', 'paid', 'waived'])->default('pending');
           $table->timestamp('due_date')->nullable();
           $table->timestamp('paid_date')->nullable();
           $table->text('notes')->nullable();
           $table->timestamps();

           // Foreign keys
           $table->foreign('loan_id')
                 ->references('id')
                 ->on('loans')
                 ->onDelete('cascade')
                 ->onUpdate('cascade');

           $table->foreign('user_id')
                 ->references('id')
                 ->on('users')
                 ->onDelete('cascade')
                 ->onUpdate('cascade');
       });
   }

   public function down()
   {
       Schema::dropIfExists('fines');
   }
}
