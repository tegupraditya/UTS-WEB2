<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillOffer extends Model
{
    // Menambahkan user_id ke dalam properti fillable
    protected $fillable = [
        'skill_offered',
        'skill_requested',
        'description',
    ];
}
