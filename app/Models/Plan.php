<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'slug', 'reference',
    ];

    public function feature()
    {
        return $this->hasMany(Feature::class);
    }

    public function user()
    {
        return $this->hasOne(UserPlan::class);
    }
}
