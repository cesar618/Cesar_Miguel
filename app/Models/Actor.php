<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'city',
        'has_car',
        'can_drive',
        'active',
        'image', // Cambiado de 'foto' a 'image'
        'notes',
    ];

    public function actorCharacters()
    {
        return $this->hasMany(ActorCharacter::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'actor_characters')
                    ->withPivot('mastery_level', 'notes')
                    ->withTimestamps();
    }
}