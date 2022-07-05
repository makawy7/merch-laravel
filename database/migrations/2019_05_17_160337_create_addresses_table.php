<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('add_1');
            $table->string('add_2')->nullable();
            $table->string('phone');
            $table->string('city');
            $table->string('country');
            $table->string('postcode')->nullable();
            $table->text('info')->nullable();
            $table->string('user_id');
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
        Schema::dropIfExists('addresses');
    }
}
