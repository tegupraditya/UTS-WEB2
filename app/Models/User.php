<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Pastikan ini ada jika Anda menggunakan Sanctum
use Illuminate\Database\Eloquent\Relations\HasOne; // Import untuk type-hinting relasi HasOne
use Illuminate\Database\Eloquent\Relations\HasMany; // Import untuk type-hinting relasi HasMany
// Pastikan model Transaction dan SkillOffer di-import
use App\Models\Transaction; 
use App\Models\SkillOffer; 
use App\Models\UserProfile; // Pastikan UserProfile juga di-import

class User extends Authenticatable // implements MustVerifyEmail (jika digunakan)
{
    use HasFactory, Notifiable; // Sesuaikan dengan trait yang Anda gunakan

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // Tambahkan field lain yang bisa diisi jika ada
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', // Di Laravel 10+, casting password ke hashed otomatis
    ];

    /**
     * Get the profile associated with the user.
     * Ini mendefinisikan relasi one-to-one: User memiliki satu UserProfile.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Get the skill offers created by the user.
     */
    public function skillOffers(): HasMany
    {
        return $this->hasMany(SkillOffer::class);
    }

    /**
     * Get the transactions initiated by the user (where this user is the requester).
     */
    public function initiatedTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'requester_user_id');
    }

    /**
     * Get a query builder for transactions related to skill offers made by this user.
     * This allows fetching transactions where this user is the original offerer.
     */
    public function getTransactionsOnMyOffersQuery()
    {
        return Transaction::whereHas('skillOffer', function ($query) {
            $query->where('user_id', $this->id);
        });
        // Untuk mendapatkan koleksi langsung (kurang fleksibel untuk paginasi di controller):
        // return $this->skillOffers->load('transactions')->pluck('transactions')->flatten();
    }

    // Relasi lama yang tidak sesuai lagi dengan struktur tabel transactions baru:
    // public function offeredTransactions(): HasMany
    // {
    //     return $this->hasMany(Transaction::class, 'offerer_id');
    // }
    // public function receivedTransactions(): HasMany
    // {
    //     return $this->hasMany(Transaction::class, 'receiver_id');
    // }
}
