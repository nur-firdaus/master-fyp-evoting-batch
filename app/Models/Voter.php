<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name', 'username', 'password', 'email', 'date_of_birth', 'address', 'is_admin'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
