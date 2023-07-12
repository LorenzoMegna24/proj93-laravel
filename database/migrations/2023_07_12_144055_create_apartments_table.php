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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->smallInteger('room');
            $table->smallInteger('bathroom');
            $table->smallInteger('bed');
            $table->integer('sq_meters')->nullable();
            $table->string('address');
            $table->integer('longitude');
            $table->integer('latitude');
            $table->string('image');
            $table->boolean('visibility')->default(1)->change();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('apartments');
    }
};
