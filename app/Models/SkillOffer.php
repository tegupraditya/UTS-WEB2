<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Pastikan HasMany di-import

// Jika Anda sudah mengimplementasikan sistem skill terstruktur, Anda mungkin perlu ini:
// use Illuminate\Database\Eloquent\Relations\BelongsToMany; 

class SkillOffer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'skill_offered',     // Ini akan tetap ada jika Anda belum beralih ke sistem skill terstruktur
        'skill_requested',   // Ini akan tetap ada jika Anda belum beralih ke sistem skill terstruktur
        'description',
        'status',            // Misalnya: 'active', 'inactive', 'completed', 'pending_approval'
    ];

    /**
     * Get the user that owns the skill offer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category for the skill offer.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the matchings associated with the skill offer.
     * Definisi model Matching dan tabel matchings perlu dibuat jika fitur ini akan dikembangkan.
     */
    public function matchings(): HasMany
    {
        // Asumsi Anda akan membuat model Matching
        return $this->hasMany(Matching::class); 
    }

    /**
     * Get the transactions associated with the skill offer.
     * Satu SkillOffer bisa memiliki banyak Transactions.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    // Komentar di bawah ini adalah untuk jika Anda beralih ke sistem skill terstruktur dengan tabel pivot
    /*
    public function offeredSkills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'skill_skill_offer', 'skill_offer_id', 'skill_id')
                    ->wherePivot('type', 'offered');
    }

    public function requestedSkills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'skill_skill_offer', 'skill_offer_id', 'skill_id')
                    ->wherePivot('type', 'requested');
    }
    */
}
