<?php

namespace App\Http\Controllers;

use App\Models\SkillOffer;
use App\Models\UserProfile;
use App\Models\User; // Jika Anda menghitung semua user, bukan hanya yang punya profil
use App\Models\Transaction; // Untuk aktivitas transaksi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $userProfile = $user->profile; // Asumsi relasi profile sudah ada di model User

        // 1. Stats Cards Data
        $skillOffersCount = SkillOffer::count(); // Atau SkillOffer::where('status', 'active')->count();
        $userProfilesCount = UserProfile::count(); // Atau User::count(); jika Anda ingin semua user terdaftar

        // Untuk $matchingCount, ini bisa kompleks. Untuk sementara, kita bisa hitung:
        // - Jumlah SkillOffer yang BUKAN milik user login, DAN
        // - skill_requested di offer tersebut cocok dengan main_skill user login, ATAU
        // - skill_offered di offer tersebut cocok dengan needed_skill user login.
        // Ini adalah definisi sederhana dan bisa disesuaikan.
        $matchingCount = 0;
        if ($userProfile && $userProfile->main_skill && $userProfile->needed_skill) {
            $matchingCount = SkillOffer::where('user_id', '!=', $user->id)
                // ->where('status', 'active') // Jika ada status
                ->where(function ($query) use ($userProfile) {
                    $query->where('skill_requested', 'LIKE', '%' . $userProfile->main_skill . '%')
                          ->orWhere('skill_offered', 'LIKE', '%' . $userProfile->needed_skill . '%');
                })
                ->count();
        }

        // 2. Recommended Matches (Sederhana untuk sekarang)
        // Ambil beberapa SkillOffer dari user lain yang mungkin relevan (strong match sederhana)
        $recommendedMatches = collect(); // Default ke koleksi kosong
        if ($userProfile && $userProfile->main_skill && $userProfile->needed_skill) {
            $recommendedMatches = SkillOffer::where('user_id', '!=', $user->id)
                // ->where('status', 'active')
                ->where('skill_requested', 'LIKE', '%' . $userProfile->main_skill . '%')
                ->where('skill_offered', 'LIKE', '%' . $userProfile->needed_skill . '%')
                ->with(['user', 'category']) // Eager load
                ->latest()
                ->take(5) // Ambil 5 terbaru sebagai contoh
                ->get();
        }

        // 3. Recent Activity (Contoh: 5 transaksi terakhir yang melibatkan pengguna)
        // Ini bisa berupa transaksi yang diajukan pengguna atau transaksi pada penawaran pengguna
        $recentActivities = Transaction::where(function ($query) use ($user) {
                $query->where('requester_user_id', $user->id)
                      ->orWhereHas('skillOffer', function ($q) use ($user) {
                          $q->where('user_id', $user->id);
                      });
            })
            ->with(['skillOffer.user', 'requester']) // Eager load
            ->latest()
            ->take(5)
            ->get();

        // 4. Your Skills (dari UserProfile)
        $myMainSkill = $userProfile->main_skill ?? null;
        $myNeededSkill = $userProfile->needed_skill ?? null;
        // Jika Anda sudah menggunakan sistem skill terstruktur (many-to-many), ambil dari relasi:
        // $myMainSkills = $userProfile ? $userProfile->mainSkills : collect();
        // $myNeededSkills = $userProfile ? $userProfile->neededSkills : collect();


        return view('dashboard', compact(
            'userProfile', // Kirim profil pengguna untuk personalisasi
            'skillOffersCount',
            'userProfilesCount',
            'matchingCount',
            'recommendedMatches',
            'recentActivities',
            'myMainSkill',
            'myNeededSkill'
            // 'myMainSkills', // Jika pakai sistem skill terstruktur
            // 'myNeededSkills'  // Jika pakai sistem skill terstruktur
        ));
    }
}
