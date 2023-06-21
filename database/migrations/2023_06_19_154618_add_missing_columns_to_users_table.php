<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('level')->after('password');
            $table->integer('experience')->after('level');
            $table->integer('status')->after('experience');
            $table->string('gender')->after('status');
            $table->unsignedBigInteger('role_id');
            $table->integer('is_active')->after('role_id');

            $table->foreign('role_id')->references('id')->on('roles');
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
            $table->dropForeign(['role_id']);
            $table->dropColumn(['level', 'experience', 'status', 'gender', 'role_id', 'is_active']);
        });
    }
}
