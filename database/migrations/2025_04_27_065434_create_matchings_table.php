<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchings', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key
            $table->bigInteger('user_profile_id')->unsigned(); // Kolom user_profile_id
            $table->bigInteger('skill_offer_id')->unsigned(); // Kolom skill_offer_id
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key untuk hubungan
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->onDelete('cascade');
            $table->foreign('skill_offer_id')->references('id')->on('skill_offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchings');
    }
}
