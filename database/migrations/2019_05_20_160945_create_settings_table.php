<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_ar');
            $table->text('icon');
            $table->text('logo');
            $table->text('terms');
            $table->text('terms_ar');
            $table->text('return_policy');
            $table->text('return_policy_ar');
            $table->text('privacy_policy');
            $table->text('privacy_policy_ar');
            $table->string('address')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('default_lang');
            $table->integer('default_currency');
            $table->text('tags');
            $table->integer('status')->default(1);
            $table->text('maintenance_msg');
            $table->text('maintenance_msg_ar');
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
        Schema::dropIfExists('settings');
    }
}
