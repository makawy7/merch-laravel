<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('extoption_id')->nullable();
            $table->integer('quantity');
            $table->double('price');
            $table->double('qprice');
            $table->integer('seller_id')->default(0);
            $table->integer('currency');
            $table->integer('paid')->default(0);
            $table->integer('delivered')->default(0);
            $table->integer('cancelled')->default(0);
            $table->integer('paymentmethod');
            $table->integer('address');
            $table->integer('status')->default(0);
            $table->integer('willbedelivered')->default(1);
            $table->integer('willnotmsg_id')->default(0);
            $table->integer('ordergroup');
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
        Schema::dropIfExists('orders');
    }
}
