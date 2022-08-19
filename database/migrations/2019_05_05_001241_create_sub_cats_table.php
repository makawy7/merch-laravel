<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_cats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_ar');
            $table->string('slug')->nullable();
            $table->string('slug_ar')->nullable();
            $table->integer('maincat_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_cats');
    }
}
