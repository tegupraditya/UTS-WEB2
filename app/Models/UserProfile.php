<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    // Menambahkan properti $fillable untuk atribut yang boleh diisi mass assignment
    protected $fillable = [
        'main_skill',
        'needed_skill',
        'bio',
    ];
}
