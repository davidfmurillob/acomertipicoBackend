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
        Schema::create('event_and_users', function (Blueprint $table) {
            $table->id();
            /* foranea Eventos */
            $table->unsignedBigInteger('events_id');
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            /* foranea Usuarios */
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('asistencia',['true','false']);
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
        Schema::dropIfExists('event_and_users');
    }
};
