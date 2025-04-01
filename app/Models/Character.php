<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'play_id',
        'name',
        'notes',
    ];

    public function play()
    {
        return $this->belongsToMany(Play::class);
    }

    public function actorCharacters(){
    
        return $this->hasMany(ActorCharacter::class);
    }

    public function actors(){
    
        return $this->belongsToMany(Actor::class, 'actor_characters')
                    ->withPivot('mastery_level', 'notes')
                    ->withTimestamps();
    }
}
