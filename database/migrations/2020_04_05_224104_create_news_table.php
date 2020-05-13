<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('title');
            $table->longText('description');
            $table->longText('slug');
            $table->string('source');
            $table->string('country');
            $table->longText('image');
            $table->longText('text');
            $table->string('type');
            $table->string('cat_id');
            $table->boolean('interesting');
            $table->boolean('add_main_slide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
