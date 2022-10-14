<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventParticipants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id();
            $table->integer('siva_user_id');
            $table->string('siva_type_user');
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('institution')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_participants');
    }
}
