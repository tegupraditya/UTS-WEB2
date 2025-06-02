<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan pengguna yang sedang login
use Illuminate\Validation\Rule; // Untuk validasi Rule::in

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = UserProfile::with('user')->latest()->paginate(10);
        return view('user_profile.index', compact('profiles')); 
    }

    /**
     * Show the form for creating a new profile for the authenticated user.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->profile) {
            return redirect()->route('user-profiles.edit.mine')
                         ->with('info', 'Anda sudah memiliki profil. Silakan edit profil Anda.');
        }
        // PERBAIKAN: Menggunakan path view 'user_profile.create'
        return view('user_profile.create', ['profile' => new UserProfile()]);
    }

    /**
     * Store a newly created profile in storage for the authenticated user.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->profile) {
            return redirect()->route('user-profiles.edit.mine')
                         ->with('error', 'Anda sudah memiliki profil. Tidak dapat membuat profil baru.');
        }

        $validatedData = $request->validate([
            'main_skill' => 'required|string|max:255',
            'needed_skill' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'date_of_birth' => 'nullable|date|before_or_equal:today',
            'gender' => ['nullable', 'string', Rule::in(['Laki-laki', 'Perempuan', 'Lainnya'])],
            'phone_number' => 'nullable|string|max:20|regex:/^[0-9\s\-\+\(\)]*$/',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'profile_picture_url' => 'nullable|url|max:2048',
        ]);

        $user->profile()->create($validatedData);

        return redirect()->route('user-profiles.show', $user->profile->id)
                         ->with('success', 'Profil Anda berhasil dibuat!');
    }

    /**
     * Display the specified user profile.
     */
    public function show(UserProfile $userProfile)
    {
        $userProfile->load('user'); 
        // PERBAIKAN: Menggunakan path view 'user_profile.show'
        return view('user_profile.show', compact('userProfile'));
    }

    /**
     * Show the form for editing the authenticated user's profile.
     */
    public function edit() 
    {
        $userProfile = Auth::user()->profile;

        if (!$userProfile) {
            return redirect()->route('user-profiles.create.mine')
                         ->with('info', 'Lengkapi profil Anda terlebih dahulu untuk bisa mengedit.');
        }
        // PERBAIKAN: Menggunakan path view 'user_profile.edit'
        return view('user_profile.edit', ['profile' => $userProfile]);
    }

    /**
     * Update the authenticated user's profile in storage.
     */
    public function update(Request $request)
    {
        $userProfile = Auth::user()->profile;

        if (!$userProfile) {
            return redirect()->route('user-profiles.create.mine')
                         ->with('error', 'Profil tidak ditemukan. Silakan buat profil terlebih dahulu.');
        }

        $validatedData = $request->validate([
            'main_skill' => 'required|string|max:255',
            'needed_skill' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'date_of_birth' => 'nullable|date|before_or_equal:today',
            'gender' => ['nullable', 'string', Rule::in(['Laki-laki', 'Perempuan', 'Lainnya'])],
            'phone_number' => 'nullable|string|max:20|regex:/^[0-9\s\-\+\(\)]*$/',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'profile_picture_url' => 'nullable|url|max:2048',
        ]);

        $userProfile->update($validatedData);

        return redirect()->route('user-profiles.show', $userProfile->id)
                         ->with('success', 'Profil Anda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        // ... (logika hapus seperti sebelumnya) ...
        return back()->with('info', 'Fungsi hapus profil belum diimplementasikan sepenuhnya atau memerlukan otorisasi admin.');
    }
}
