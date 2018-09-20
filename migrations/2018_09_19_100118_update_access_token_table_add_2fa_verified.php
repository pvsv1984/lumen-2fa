<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAccessTokenTableAdd2faVerified extends Migration
{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
                Schema::table('oauth_access_tokens', function (Blueprint $table) {
                        $table->boolean('twofactor_verified')->nullable();
                });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
                Schema::table('oauth_access_tokens', function (Blueprint $table) {
                        $table->dropColumn('twofactor_verified');
                });
        }
}