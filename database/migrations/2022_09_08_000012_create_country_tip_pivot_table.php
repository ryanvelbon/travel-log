<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTipPivotTable extends Migration
{
    public function up()
    {
        Schema::create('country_tip', function (Blueprint $table) {
            $table->unsignedBigInteger('tip_id');
            $table->foreign('tip_id', 'tip_id_fk_7277226')->references('id')->on('tips')->onDelete('cascade');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id', 'country_id_fk_7277226')->references('id')->on('countries')->onDelete('cascade');
        });
    }
}
