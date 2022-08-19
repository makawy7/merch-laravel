<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country_code')->after('phone')->nullable();
            $table->string('country_iso2')->after('country_code')->nullable();
            $table->string('code')->after('country_iso2')->nullable();
            $table->timestamp('phone_verified_at')->after('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('country_code');
        });
    }
}
