<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_offers', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('skill_offered'); // Kolom skill yang ditawarkan
            $table->string('skill_requested'); // Kolom skill yang diminta
            $table->text('description')->nullable(); // Kolom deskripsi skill yang ditawarkan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_offers');
    }
}
