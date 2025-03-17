<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorCharacter extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_id',
        'character_id',
        'mastery_level',
        'notes',
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function eventCasts(){
    
        return $this->hasMany(EventCast::class);
    }
}