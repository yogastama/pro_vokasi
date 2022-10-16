<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProVokasiServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_vokasi_services', function (Blueprint $table) {
            $table->id();
            $table->string('banner');
            $table->string('youtube_video');
            $table->string('name');
            $table->string('short_name');
            $table->text('content');
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
        Schema::dropIfExists('pro_vokasi_services');
    }
}
