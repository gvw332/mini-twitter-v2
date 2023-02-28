<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'img',
        'video',
        // Autres champs remplissables
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}