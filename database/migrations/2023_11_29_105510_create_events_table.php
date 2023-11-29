<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->integer('slots_available');
            $table->unsignedBigInteger('created_by_user_id');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * id, title, description, date, time, location, slots_available, created_by_user_id, created_at, updated_at
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
