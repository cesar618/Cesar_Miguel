<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'play_id',
        'date',
        'start_time',
        'end_time',
        'description',
        'url_info',
        'url_tickets',
        'location_id',
    ];

    public function play(){
    
        return $this->belongsTo(Play::class);
    }
    
    public function location(){
    
        return $this->belongsTo(Location::class);
    }
    
    public function eventCast(){
   
        return $this->hasMany(EventCast::class);
    }
    
    public function eventRoles(){
    
        return $this->hasMany(EventRole::class);
    }
    
    public function logistics(){
    
        return $this->hasMany(Logistic::class);
    }
    
    public function roadmaps(){
    
        return $this->hasMany(Roadmap::class);
    }
    
}

