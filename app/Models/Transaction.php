<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'skill_offer_id',
        'requester_user_id',
        'status',
        'notes_requester',
        'notes_offerer',
        'accepted_at',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'accepted_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the skill offer associated with the transaction.
     */
    public function skillOffer(): BelongsTo
    {
        return $this->belongsTo(SkillOffer::class);
    }

    /**
     * Get the user who requested/initiated the transaction on the skill offer.
     */
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_user_id');
    }

    /**
     * Get the user who originally offered the skill (owner of the SkillOffer).
     * This is an accessor that retrieves the offerer through the skillOffer relationship.
     */
    public function getOffererAttribute()
    {
        // Memastikan relasi skillOffer sudah di-load atau akan di-load
        // untuk menghindari N+1 problem jika diakses dalam loop tanpa eager loading.
        if (!$this->relationLoaded('skillOffer')) {
            $this->load('skillOffer.user');
        } elseif ($this->skillOffer && !$this->skillOffer->relationLoaded('user')) {
            $this->skillOffer->load('user');
        }
        
        return $this->skillOffer ? $this->skillOffer->user : null;
    }
}
