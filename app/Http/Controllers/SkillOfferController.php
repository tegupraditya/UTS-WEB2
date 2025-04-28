<?php

namespace App\Http\Controllers;

use App\Models\SkillOffer;
use Illuminate\Http\Request;

class SkillOfferController extends Controller
{
    public function index()
    {
        $offers = SkillOffer::all(); // Semua skill offer, bukan per user
        return view('skill_offer.index', compact('offers'));
    }

    public function create()
    {
        return view('skill_offer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill_offered' => 'required|string|max:255',
            'skill_requested' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        SkillOffer::create($request->only(['skill_offered', 'skill_requested', 'description']));

        return redirect()->route('skill-offers.index')->with('success', 'Skill offer created successfully.');
    }

    public function show(SkillOffer $skillOffer)
    {
        return view('skill_offer.show', compact('skillOffer'));
    }

    public function edit(SkillOffer $skillOffer)
    {
        return view('skill_offer.edit', compact('skillOffer'));
    }

    public function update(Request $request, SkillOffer $skillOffer)
    {
        $request->validate([
            'skill_offered' => 'required|string|max:255',
            'skill_requested' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $skillOffer->update($request->only(['skill_offered', 'skill_requested', 'description']));

        return redirect()->route('skill-offers.index')->with('success', 'Skill offer updated successfully.');
    }

    public function destroy(SkillOffer $skillOffer)
    {
        $skillOffer->delete();
        return redirect()->route('skill-offers.index')->with('success', 'Skill offer deleted successfully.');
    }

    public function dashboard()
    {
        $totalSkillOffers = SkillOffer::count();
        $recentSkillOffers = SkillOffer::latest()->take(5)->get();

        return view('dashboard', [
            'totalSkillOffers' => $totalSkillOffers,
            'recentSkillOffers' => $recentSkillOffers,
        ]);
    }
}
