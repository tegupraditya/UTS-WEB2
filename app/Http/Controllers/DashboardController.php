<?php

namespace App\Http\Controllers;

use App\Models\SkillOffer;
use App\Models\UserProfile;
use App\Models\Matching;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Ambil semua jumlah skill offers, user profiles, dan matchings
        $skillOffersCount = SkillOffer::count();
        $userProfilesCount = UserProfile::count();
        $matchingCount = Matching::count();

        // Ambil 5 profil terbaru dan skill offer terbaru
        $recentProfiles = UserProfile::latest()->take(5)->get();
        $recentSkillOffers = SkillOffer::latest()->take(5)->get();

        // Ambil recommended matches
        $recommendedMatches = $this->getRecommendedMatches();

        // Kirimkan semua data ke view dashboard
        return view('dashboard', compact(
            'skillOffersCount',
            'userProfilesCount',
            'matchingCount',
            'recentProfiles',
            'recentSkillOffers',
            'recommendedMatches'
        ));
    }

    private function getRecommendedMatches()
    {
        // Logika sederhana, misal ambil semua Matching
        return Matching::latest()->take(5)->get();
    }
}
