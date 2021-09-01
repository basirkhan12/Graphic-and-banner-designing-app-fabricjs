<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'skills')){
                $table->string('skills')->after('cover');
              };
            if (!Schema::hasColumn('users', 'slogon')){
                $table->string('slogon')->after('skills');
              };
            if (!Schema::hasColumn('users', 'slogon')){
                $table->text('about')->after('slogon');
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
