<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Nama kelas migrasi mungkin perlu disesuaikan jika Anda membuat file baru
// Misalnya: class CreateUserProfilesWithBiodataTable extends Migration
class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key

            // Foreign key ke tabel users
            // Pastikan tabel 'users' sudah ada sebelum migrasi ini dijalankan
            $table->foreignId('user_id')
                  ->constrained() // Ini mengasumsikan tabel users memiliki kolom 'id'
                  ->onDelete('cascade'); // Jika user dihapus, profilnya juga ikut terhapus

            $table->string('main_skill'); // Kolom untuk skill utama
            $table->string('needed_skill'); // Kolom untuk skill yang dibutuhkan
            $table->text('bio')->nullable(); // Kolom bio yang bisa kosong

            // Field biodata baru
            $table->date('date_of_birth')->nullable(); // Tanggal Lahir
            $table->string('gender')->nullable(); // Jenis Kelamin (misal: Laki-laki, Perempuan, Lainnya)
            $table->string('phone_number')->nullable(); // Nomor Telepon
            $table->text('address')->nullable(); // Alamat Lengkap
            $table->string('city')->nullable(); // Kota
            $table->string('province')->nullable(); // Provinsi
            $table->string('postal_code')->nullable(); // Kode Pos
            $table->string('profile_picture_url')->nullable(); // URL Foto Profil

            $table->timestamps(); // Kolom created_at dan updated_at

            // Membuat user_id unik untuk memastikan satu user hanya punya satu profil
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
