<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportStaff extends Model
{
    use HasFactory, SoftDeletes;

    protected$fillable= [

        'first_name',
        'last_name',
        'phone',
        'email',
        'city',
        'has_car',   
        'can_drive', 
        'active',    
        'notes',
        
    ];


     public function supportStaffRoles(){

        return $this->hasMany(SupportStaffRole::class);
     }

     public function roles()
    {
        return $this->belongsToMany(Role::class, 'support_staff_roles')
                    ->withPivot('mastery_level', 'notes')
                    ->withTimestamps();
    }

}
