<?php

namespace App\Http\Controllers;

use App\Models\SkillOffer;
use App\Models\Category; // Import model Category
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade untuk mendapatkan user ID

class SkillOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil hanya skill offers milik user yang sedang login
        // Menggunakan relasi Auth::user()->skillOffers() untuk memastikan kepemilikan
        // JIKA ANDA INGIN MENAMPILKAN SEMUA OFFER (BUKAN HANYA MILIK USER LOGIN) DI HALAMAN INDEX INI, UBAH QUERYNYA:
        // $offers = SkillOffer::with(['user', 'category'])->latest()->paginate(10); // Contoh untuk semua offer
        $offers = Auth::user()->skillOffers()->with('category')->latest()->get(); // Kode Anda sebelumnya, hanya offer milik user login
        
        // Sesuaikan path view jika berbeda, misalnya 'skill_offers.index'
        return view('skill_offer.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        // Sesuaikan path view jika berbeda
        return view('skill_offer.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Validasi category_id
            'skill_offered' => 'required|string|max:255',
            'skill_requested' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Tambahkan validasi untuk 'status' jika Anda sudah menambahkannya ke $fillable dan form
            // 'status' => 'required|string|in:active,inactive', 
        ]);

        Auth::user()->skillOffers()->create([
            'category_id' => $request->category_id,
            'skill_offered' => $request->skill_offered,
            'skill_requested' => $request->skill_requested,
            'description' => $request->description,
            // 'status' => $request->status ?? 'active', // Set status default jika ada
        ]);

        return redirect()->route('skill-offers.index')->with('success', 'Skill offer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SkillOffer  $skillOffer
     * @return \Illuminate\Http\Response
     */
    public function show(SkillOffer $skillOffer)
    {
        // OTORISASI KEPEMILIKAN DIHAPUS DARI SINI
        // // Periksa apakah skill offer ini milik user yang sedang login
        // if ($skillOffer->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized. You do not own this skill offer.'); // Mengembalikan error 403 jika tidak berwenang
        // }

        // Eager load relasi 'user' (beserta profile user) dan 'category' untuk ditampilkan di view
        $skillOffer->load(['user.profile', 'category']); 
        
        // Sesuaikan path view jika berbeda
        return view('skill_offer.show', compact('skillOffer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SkillOffer  $skillOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(SkillOffer $skillOffer)
    {
        // Otorisasi: Pastikan hanya pemilik yang bisa mengedit
        if ($skillOffer->user_id !== Auth::id()) {
            // Anda bisa menggunakan abort(403) atau redirect dengan pesan error
            return redirect()->route('skill-offers.index')->with('error', 'You are not authorized to edit this skill offer.');
            // atau: abort(403, 'UNAUTHORIZED ACTION.');
        }

        $categories = Category::all(); 
        // Sesuaikan path view jika berbeda
        return view('skill_offer.edit', compact('skillOffer', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SkillOffer  $skillOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SkillOffer $skillOffer)
    {
        // Otorisasi: Pastikan hanya pemilik yang bisa mengupdate
        if ($skillOffer->user_id !== Auth::id()) {
            return redirect()->route('skill-offers.index')->with('error', 'You are not authorized to update this skill offer.');
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'skill_offered' => 'required|string|max:255',
            'skill_requested' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'status' => 'required|string|in:active,inactive', // Jika ada field status
        ]);

        $skillOffer->update([
            'category_id' => $request->category_id,
            'skill_offered' => $request->skill_offered,
            'skill_requested' => $request->skill_requested,
            'description' => $request->description,
            // 'status' => $request->status, // Jika ada field status
        ]);

        return redirect()->route('skill-offers.show', $skillOffer->id)->with('success', 'Skill offer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SkillOffer  $skillOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkillOffer $skillOffer)
    {
        // Otorisasi: Pastikan hanya pemilik yang bisa menghapus
        if ($skillOffer->user_id !== Auth::id()) {
            return redirect()->route('skill-offers.index')->with('error', 'You are not authorized to delete this skill offer.');
        }

        $skillOffer->delete();
        return redirect()->route('skill-offers.index')->with('success', 'Skill offer deleted successfully.');
    }

    /**
     * Menampilkan data dashboard terkait Skill Offers.
     * Method ini sepertinya lebih cocok di DashboardController,
     * tapi saya biarkan di sini sesuai kode awal Anda.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $totalSkillOffers = SkillOffer::count();
        $recentSkillOffers = SkillOffer::latest()->take(5)->with(['user', 'category'])->get();

        // Pastikan view 'dashboard' ada dan menerima variabel ini
        return view('dashboard', [
            'totalSkillOffers' => $totalSkillOffers,
            'recentSkillOffers' => $recentSkillOffers,
        ]);
    }
}
