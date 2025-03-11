<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Cast extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'actor_character_id',
        'leader',
    ];

    public function event(){
    
        return $this->belongsTo(Event::class);
    }

    public function actorCharacter(){
    
        return $this->belongsTo(ActorCharacter::class);
    }
}
