<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\SkillOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Penting untuk mendapatkan user yang login

class MatchingController extends Controller
{
    public function index(Request $request) // Tambahkan Request jika ingin ada filter dari user nanti
    {
        $user = Auth::user();

        // 1. Pastikan pengguna sudah login dan memiliki profil
        if (!$user || !$user->profile) {
            return redirect()->route('user-profiles.create.mine') // atau rute yang sesuai
                             ->with('info', 'Harap lengkapi profil Anda terlebih dahulu untuk melihat kecocokan skill.');
        }

        $myProfile = $user->profile;
        $myMainSkill = $myProfile->main_skill;
        $myNeededSkill = $myProfile->needed_skill;

        // Jika pengguna belum mengisi skill utama atau skill yang dibutuhkan di profilnya
        if (empty($myMainSkill) || empty($myNeededSkill)) {
             return redirect()->route('user-profiles.edit.mine') // Arahkan ke edit profil
                             ->with('info', 'Harap lengkapi Keahlian Utama dan Keahlian yang Dicari di profil Anda untuk menemukan kecocokan.');
        }

        // 2. Cari SkillOffer dari pengguna lain
        $query = SkillOffer::where('user_id', '!=', $user->id) // Bukan penawaran sendiri
                           // ->where('status', 'active') // DIHAPUS SEMENTARA KARENA KOLOM TIDAK ADA
                           ->with(['user.profile', 'category']); // Eager load untuk ditampilkan di view

        // A. Strong Matches: Mereka butuh apa yang saya punya, DAN mereka tawarkan apa yang saya butuh
        $strongMatchesQuery = clone $query; // Clone query dasar agar tidak saling mempengaruhi
        $strongMatches = $strongMatchesQuery
            ->where('skill_requested', 'LIKE', '%' . $myMainSkill . '%')
            ->where('skill_offered', 'LIKE', '%' . $myNeededSkill . '%')
            ->latest()
            ->paginate(6, ['*'], 'strong_matches_page'); // Paginasi dengan nama halaman berbeda

        // B. Partial Matches - You Can Help Them: Mereka butuh apa yang saya punya
        $youCanHelpQuery = clone $query;
        $youCanHelpThem = $youCanHelpQuery
            ->where('skill_requested', 'LIKE', '%' . $myMainSkill . '%')
            ->latest()
            ->paginate(6, ['*'], 'you_can_help_page');

        // C. Partial Matches - They Can Help You: Mereka tawarkan apa yang saya butuh
        $theyCanHelpQuery = clone $query;
        $theyCanHelpYou = $theyCanHelpQuery
            ->where('skill_offered', 'LIKE', '%' . $myNeededSkill . '%')
            ->latest()
            ->paginate(6, ['*'], 'they_can_help_page');

        // Pastikan view 'matching.index' sudah ada dan siap menerima data ini
        return view('matching.index', compact('myProfile', 'strongMatches', 'youCanHelpThem', 'theyCanHelpYou'));
    }

    public function show($id) // $id di sini adalah ID UserProfile target
    {
        $targetProfile = UserProfile::with('user')->findOrFail($id);
        $user = Auth::user();

        if ($user && $user->profile && $user->profile->id == $targetProfile->id) {
            return redirect()->route('matching.index');
        }
        
        $matchingOffers = SkillOffer::where('user_id', '!=', $targetProfile->user_id)
                                 // ->where('status', 'active') // DIHAPUS SEMENTARA KARENA KOLOM TIDAK ADA
                                 ->where('skill_requested', 'LIKE', '%' . $targetProfile->main_skill . '%')
                                 ->where('skill_offered', 'LIKE', '%' . $targetProfile->needed_skill . '%')
                                 ->with(['user.profile', 'category'])
                                 ->latest()
                                 ->paginate(10);

        return view('matching.show', compact('targetProfile', 'matchingOffers'));
    }
}
