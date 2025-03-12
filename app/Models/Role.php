<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'name',
        'notes',
    ];

    public function supportStaffRoles()
    {
        return $this->hasMany(SupportStaffRole::class);
    }

    public function supportStaff(){
    
        return $this->belongsToMany(SupportStaff::class, 'support_staff_roles')
                    ->withPivot('mastery_level', 'notes')
                    ->withTimestamps();
    }

}
