<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdergroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordergroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('order_number');
            $table->integer('shippingmethod');
            $table->integer('paymentmethod');
            $table->integer('currency');
            $table->integer('address');
            $table->integer('status')->default(0);
            $table->integer('delivered')->default(0);
            $table->string('carrier')->nullable();
            $table->text('trackingnumber')->nullable();
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
        Schema::dropIfExists('ordergroups');
    }
}
