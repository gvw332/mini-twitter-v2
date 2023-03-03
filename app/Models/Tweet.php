<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

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
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function isLikedBy(User $user)
    {
        if ($user) {
            return $this->likes->contains('user_id', $user->id);
        }
        // Gérer le cas où $user est null
        throw new InvalidArgumentException('$user ne peut pas être null');
    }
}
?>

