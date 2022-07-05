<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('title_ar');
            $table->string('slug')->nullable();
            $table->string('slug_ar')->nullable();
            $table->text('des');
            $table->text('des_ar');
            $table->text('head_des')->nullable();
            $table->text('head_des_ar')->nullable();
            $table->double('old_price')->nullable();
            $table->double('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('seller_id');
            $table->integer('type_id');
            $table->integer('brand_id')->nullable();
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->text('tags');
            $table->integer('sales')->default(0);
            $table->integer('featured')->default(0);
            $table->integer('views')->default(0);
            $table->integer('active')->default(1);
            $table->integer('hasoffer')->default(0);
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
        Schema::dropIfExists('products');
    }
}
