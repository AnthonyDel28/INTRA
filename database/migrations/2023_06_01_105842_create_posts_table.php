<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author');
            $table->unsignedBigInteger('section');
            $table->text('message');
            $table->text('code')->nullable();
            $table->integer('likes')->default(0);
            $table->timestamps();
            $table->boolean('is_active')->default(true);

            $table->foreign('author')->references('id')->on('user');
            //$table->foreign('section')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
