<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Play extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'producer_id',
        'active',
        'notes',
    ];

    public function producer(){
    
        return $this->belongsTo(Producer::class);
    }

    public function characters(){
    
    return $this->hasMany(Character::class);
    }

    public function events(){

    return $this->hasMany(Event::class);
    }

}