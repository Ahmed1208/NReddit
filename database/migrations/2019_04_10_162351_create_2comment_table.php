<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create2commentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondcomments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('second_comment');
            $table->bigInteger('comment_id')->unsigned();
            $table->bigInteger('user_id_second_comment')->unsigned();
            $table->timestamps();

            $table->foreign('comment_id')->references('id')->on('comments');
            $table->foreign('user_id_second_comment')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secondcomments');
    }
}
