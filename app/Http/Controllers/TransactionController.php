<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\SkillOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions relevant to the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil transaksi di mana pengguna adalah peminta (initiated)
        $initiatedTransactions = $user->initiatedTransactions()
                                      ->with(['skillOffer.user', 'skillOffer.category']) // Eager load relasi
                                      ->latest()
                                      ->paginate(10, ['*'], 'initiated_page');

        // Ambil transaksi yang terkait dengan SkillOffer milik pengguna (dimana pengguna adalah offerer asli)
        // Menggunakan query builder yang kita buat di model User
        $transactionsOnMyOffers = $user->getTransactionsOnMyOffersQuery()
                                       ->with(['skillOffer.user', 'skillOffer.category', 'requester']) // Eager load relasi
                                       ->latest()
                                       ->paginate(10, ['*'], 'on_my_offers_page');
        
        // Anda perlu membuat view 'transactions.index'
        return view('transactions.index', compact('initiatedTransactions', 'transactionsOnMyOffers'));
    }

    /**
     * Show the form for creating a new transaction proposal.
     * Biasanya, ini tidak berupa halaman form terpisah, tapi aksi dari halaman SkillOffer.
     * Jadi, method ini mungkin tidak terlalu diperlukan jika pembuatan proposal langsung dari tombol.
     *
     * @param  \App\Models\SkillOffer  $skillOffer
     * @return \Illuminate\Http.Response
     */
    // public function create(SkillOffer $skillOffer)
    // {
    //     // Tampilkan form jika diperlukan, atau langsung ke store dari tombol di halaman SkillOffer
    // }

    /**
     * Store a newly created transaction proposal in storage.
     * Ini akan dipicu ketika pengguna mengajukan pertukaran pada sebuah SkillOffer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SkillOffer  $skillOffer (dari parameter rute)
     * @return \Illuminate\Http\Response
     */
    public function storeProposal(Request $request, SkillOffer $skillOffer)
    {
        $requester = Auth::user();

        // 1. Validasi:
        // - Pastikan pengguna tidak mengajukan transaksi pada penawarannya sendiri
        if ($skillOffer->user_id == $requester->id) {
            return back()->with('error', 'Anda tidak dapat mengajukan transaksi pada penawaran Anda sendiri.');
        }
        // - Pastikan belum ada transaksi aktif/pending dari user ini untuk offer ini
        $existingTransaction = Transaction::where('skill_offer_id', $skillOffer->id)
                                          ->where('requester_user_id', $requester->id)
                                          ->whereIn('status', ['pending_proposal', 'accepted', 'in_progress'])
                                          ->first();
        if ($existingTransaction) {
            return back()->with('info', 'Anda sudah memiliki proposal transaksi yang aktif atau menunggu untuk penawaran ini.');
        }

        // 2. Buat Transaksi Baru
        $transaction = Transaction::create([
            'skill_offer_id' => $skillOffer->id,
            'requester_user_id' => $requester->id,
            'status' => 'pending_proposal', // Status awal
            'notes_requester' => $request->input('notes_requester'), // Jika ada field catatan di form pengajuan
        ]);

        // 3. Notifikasi ke Pemilik SkillOffer (bisa diimplementasikan nanti)
        // $skillOffer->user->notify(new NewTransactionProposal($transaction));

        return redirect()->route('transactions.show', $transaction->id) // Arahkan ke detail transaksi yang baru dibuat
                         ->with('success', 'Proposal transaksi berhasil diajukan. Menunggu persetujuan dari pemilik penawaran.');
    }

    /**
     * Display the specified transaction.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        // Otorisasi: Pastikan pengguna yang login adalah requester atau offerer dari transaksi ini
        $user = Auth::user();
        $offerer = $transaction->skillOffer->user; // Pengguna pemilik SkillOffer

        if ($user->id !== $transaction->requester_user_id && $user->id !== $offerer->id) {
            abort(403, 'Anda tidak diizinkan melihat transaksi ini.');
        }

        $transaction->load(['skillOffer.user', 'skillOffer.category', 'requester.profile']); // Eager load
        
        // Anda perlu membuat view 'transactions.show'
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Update the status of the specified transaction in storage.
     * (Misalnya: offerer menerima/menolak, atau menandai selesai)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Transaction $transaction)
    {
        $user = Auth::user();
        $offerer = $transaction->skillOffer->user;

        // Validasi input status baru
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in([
                'accepted', 'rejected', 'in_progress', 'completed', 
                'cancelled_by_offerer', 'cancelled_by_requester'
            ])],
            'notes_offerer' => 'nullable|string|max:1000', // Jika offerer menambahkan catatan saat update status
            'notes_requester' => 'nullable|string|max:1000', // Jika requester menambahkan catatan saat update status
        ]);

        $newStatus = $validated['status'];
        $originalStatus = $transaction->status;

        // Otorisasi dan Logika Perubahan Status
        // Ini bisa menjadi cukup kompleks tergantung alur kerja Anda

        // Contoh: Offerer menerima proposal
        if ($newStatus === 'accepted' && $originalStatus === 'pending_proposal' && $user->id === $offerer->id) {
            $transaction->status = 'accepted';
            $transaction->accepted_at = now();
            if($request->filled('notes_offerer')) {
                $transaction->notes_offerer = $validated['notes_offerer'];
            }
            // Notifikasi ke requester bahwa proposal diterima
            // $transaction->requester->notify(new TransactionProposalAccepted($transaction));
        }
        // Contoh: Offerer menolak proposal
        elseif ($newStatus === 'rejected' && $originalStatus === 'pending_proposal' && $user->id === $offerer->id) {
            $transaction->status = 'rejected';
            if($request->filled('notes_offerer')) {
                $transaction->notes_offerer = $validated['notes_offerer'];
            }
            // Notifikasi ke requester bahwa proposal ditolak
            // $transaction->requester->notify(new TransactionProposalRejected($transaction));
        }
        // Contoh: Salah satu pihak menandai selesai (setelah status 'accepted' atau 'in_progress')
        elseif ($newStatus === 'completed' && in_array($originalStatus, ['accepted', 'in_progress'])) {
            // Pastikan hanya offerer atau requester yang bisa menandai selesai
            if ($user->id === $offerer->id || $user->id === $transaction->requester_user_id) {
                $transaction->status = 'completed';
                $transaction->completed_at = now();
                // Notifikasi ke pihak lain bahwa transaksi ditandai selesai
            } else {
                return back()->with('error', 'Anda tidak diizinkan mengubah status transaksi ini.');
            }
        }
        // Tambahkan logika untuk status lain seperti 'in_progress', 'cancelled', dll.
        else {
            return back()->with('error', 'Perubahan status tidak valid atau Anda tidak diizinkan.');
        }

        $transaction->save();

        return redirect()->route('transactions.show', $transaction->id)
                         ->with('success', 'Status transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * (Biasanya transaksi tidak dihapus, tapi mungkin dibatalkan atau diarsipkan)
     */
    // public function destroy(Transaction $transaction)
    // {
    //     // Logika hapus dengan otorisasi
    // }
}
