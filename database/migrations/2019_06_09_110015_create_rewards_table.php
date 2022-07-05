<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('review')->default(0);
            $table->integer('review_points')->default(0);
            $table->integer('email')->default(0);
            $table->integer('email_points')->default(0);
            $table->integer('phone')->default(0);
            $table->integer('phone_points')->default(0);
            $table->integer('product')->default(0);
            $table->integer('product_points')->default(0);
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
        Schema::dropIfExists('rewards');
    }
}
