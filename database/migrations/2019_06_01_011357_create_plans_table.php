<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_ar');
            $table->text('des')->nullable();
            $table->text('des_ar')->nullable();
            $table->double('price')->default(0);
            $table->double('fee');
            $table->double('min_fee');
            $table->double('max_fee');
            $table->integer('product_priority');
            $table->integer('product_limit')->nullable();
            $table->integer('trans_limit')->nullable();
            $table->integer('deleted_counter')->nullable();
            $table->integer('photo_limit')->default(5);
            $table->integer('variations')->default(1);
            $table->text('badge')->nullable();
            $table->integer('staff_accounts');
            $table->integer('can_see_views')->default(0);
            $table->integer('analytics')->default(0);
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
        Schema::dropIfExists('plans');
    }
}
