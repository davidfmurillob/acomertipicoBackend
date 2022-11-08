<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40 );
            $table->string('time',10);
            $table->text('elaboration');
            $table->string('type',45);
            $table->string('image');
            $table->string('video_link', 200);
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
        Schema::dropIfExists('food_recipes');
    }
};
