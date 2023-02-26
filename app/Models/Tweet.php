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
        // Autres champs remplissables
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// <?php

// namespace App\Models;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Tweet extends Model
// {
//     protected $fillable = [
//         'text',
//         // Autres champs remplissables
//     ];

//     // Autres méthodes de la classe
// }