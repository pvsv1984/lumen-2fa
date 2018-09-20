<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableAddTwofactorCode extends Migration
{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
                Schema::table(config('lumen2fa.users_table', 'users'), function(Blueprint $table) {
                        $table->string('twofactor_secret')->nullable();
                });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
                Schema::table(config('lumen2fa.users_table', 'users'), function(Blueprint $table) {
                        $table->dropColumn('twofactor_secret');
                });
        }
}
