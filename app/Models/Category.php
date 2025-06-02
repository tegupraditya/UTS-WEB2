<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relasi: Satu Category bisa memiliki banyak SkillOffer.
     */
    public function skillOffers()
    {
        return $this->hasMany(SkillOffer::class);
    }
}