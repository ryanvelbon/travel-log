<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->decimal('amount_eur', 15, 2);
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('category');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
