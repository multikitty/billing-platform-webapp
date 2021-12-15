<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function members() {
        return $this->hasMany(User::class);
    }

    public function practice_setting() {
        return $this->hasOne(PracticeSetting::class);
    }
}
