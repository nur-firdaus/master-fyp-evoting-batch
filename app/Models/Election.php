<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'is_active'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
