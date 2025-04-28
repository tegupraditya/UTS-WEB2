<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $profiles = UserProfile::all();
        return view('user_profile.index', compact('profiles'));
    }

    public function create()
    {
        return view('user_profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'main_skill' => 'required|string|max:255',
            'needed_skill' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        UserProfile::create($request->only(['main_skill', 'needed_skill', 'bio']));

        return redirect()->route('user-profiles.index')->with('success', 'User profile created successfully.');
    }

    public function show(UserProfile $userProfile)
    {
        return view('user_profile.show', compact('userProfile'));
    }

    public function edit(UserProfile $userProfile)
    {
        return view('user_profile.edit', compact('userProfile'));
    }

    public function update(Request $request, UserProfile $userProfile)
    {
        $request->validate([
            'main_skill' => 'required|string|max:255',
            'needed_skill' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $userProfile->update($request->only(['main_skill', 'needed_skill', 'bio']));

        return redirect()->route('user-profiles.index')->with('success', 'User profile updated successfully.');
    }

    public function destroy(UserProfile $userProfile)
    {
        $userProfile->delete();
        return redirect()->route('user-profiles.index')->with('success', 'User profile deleted successfully.');
    }
}
