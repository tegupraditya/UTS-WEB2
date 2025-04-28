<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\SkillOffer;
use Illuminate\Http\Request;

class MatchingController extends Controller
{
    public function index()
    {
        // Ambil semua profile user yang punya skill
        $profiles = UserProfile::all();

        // Ambil semua skill offer
        $offers = SkillOffer::all();

        return view('matching.index', compact('profiles', 'offers'));
    }

    public function show($id)
    {
        // Menampilkan detail hasil matching
        $profile = UserProfile::findOrFail($id);
        $offers = SkillOffer::where('skill_requested', $profile->main_skill)->get();

        return view('matching.show', compact('profile', 'offers'));
    }
}
