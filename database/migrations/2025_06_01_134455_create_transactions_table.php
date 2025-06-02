// database/migrations/xxxx_xx_xx_xxxxxx_create_transactions_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_offer_id')->constrained('skill_offers')->onDelete('cascade');
            // user_id dari SkillOffer adalah offerer_user_id yang asli dari penawaran itu
            // $table->foreignId('offerer_user_id')->constrained('users')->onDelete('cascade'); // Pembuat SkillOffer asli
            $table->foreignId('requester_user_id')->constrained('users')->onDelete('cascade'); // Pengguna yang merespon/meminta transaksi pada SkillOffer

            $table->enum('status', [
                'pending_proposal', // Diajukan oleh requester, menunggu approval offerer
                'accepted',         // Disetujui oleh offerer (dan requester jika ada langkah konfirmasi balik)
                'rejected',         // Ditolak oleh offerer
                'in_progress',      // Sedang berlangsung
                'completed',        // Selesai
                'cancelled_by_offerer',
                'cancelled_by_requester',
                'disputed'
            ])->default('pending_proposal');

            $table->text('notes_requester')->nullable(); // Catatan dari pihak peminta
            $table->text('notes_offerer')->nullable();  // Catatan dari pihak pembuat penawaran (saat menyetujui/menolak)
            
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};