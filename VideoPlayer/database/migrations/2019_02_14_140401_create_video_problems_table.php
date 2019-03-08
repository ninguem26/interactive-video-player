<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_problems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('video_content_id');
            $table->string('type');
            $table->string('question');
            $table->json('alternatives');
            $table->json('answers');
            $table->timestamps();
            $table->foreign('video_content_id')->references('id')->on('video_contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_problems');
    }
}
