<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'owner_id',
    ];

    public function members()
    {
        return $this->belongsToMany(User::class)->withPivot('role','joined_at','left_at')->withTimestamps();
    }
}
