<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportStaffRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_staff_id',
        'role_id',
        'mastery_level',
        'notes',
    ];

    public function supportStaff()
    {
        return $this->belongsTo(SupportStaff::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function eventRoles(){
    
        return $this->hasMany(EventRole::class);
    }
}

