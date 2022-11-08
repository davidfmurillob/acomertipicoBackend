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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('name', 80);
            $table->text('description');
=======
            $table->string('name');
            $table->string('description');
>>>>>>> 2e5e8e9c72013398ce72dcad809531151ccd5c80
            $table->string('image');
            $table->date('ends');

            /* RELACION rol admin */
            
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
        Schema::dropIfExists('promotions');
    }
};
