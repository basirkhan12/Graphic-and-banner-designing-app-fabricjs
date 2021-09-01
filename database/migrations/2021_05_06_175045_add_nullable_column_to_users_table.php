<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableColumnToUsersTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'skills')){
                $table->string('skills')->nullable()->change();
              };
            if (Schema::hasColumn('users', 'slogon')){
                $table->string('slogon')->nullable()->change();
              };
            if (Schema::hasColumn('users', 'slogon')){
                $table->text('about')->nullable()->change();
              };
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
            //
            $table->dropColumn(['slogon','users', 'about']);
            

        });
    }
}
