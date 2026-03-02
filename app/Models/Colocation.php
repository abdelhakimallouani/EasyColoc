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

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role','joined_at','left_at')->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(User::class)->withPivot('role','joined_at','left_at')->withTimestamps();
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
