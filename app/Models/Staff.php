<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['event_id', 'role', 'level', 'name', 'phone'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}