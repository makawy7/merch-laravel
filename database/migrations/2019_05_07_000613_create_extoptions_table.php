<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extoptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('old_price')->nullable();
            $table->double('price');
            $table->integer('quantity');
            $table->string('image')->nullable();
            $table->integer('sales')->default(0);
            $table->integer('active')->default(0);
            $table->integer('hasoffer')->default(0);
            $table->integer('product_id');
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
        Schema::dropIfExists('extoptions');
    }
}
