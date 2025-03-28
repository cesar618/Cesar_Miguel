<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'support_staff_roles_id',
        'leader',
    ];

    public function event(){
    
        return $this->belongsTo(Event::class);
    }

    public function supportStaffRole(){
    
        return $this->belongsTo(SupportStaffRole::class);
    }
}

