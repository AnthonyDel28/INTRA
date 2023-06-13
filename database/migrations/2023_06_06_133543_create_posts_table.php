<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author');
            $table->unsignedBigInteger('section');
            $table->text('message');
            $table->text('code');
            $table->timestamps();
            $table->integer('is_active');

            $table->foreign('author')->references('id')->on('users');
            // $table->foreign('section')->references('id')->on('sections');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
