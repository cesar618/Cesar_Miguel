<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'time',
        'description',
        'url_map',
        'importance',
        'notes',
    ];

    public function event(){
    
        return $this->belongsTo(Event::class);
    }
}
