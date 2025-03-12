<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;


    protected $fillable = [
        'city',
        'province',
        'region',
        'street_type',
        'street_name',
        'street_number',
        'postal_code',
        'url_map',
        'phone',
        'active',
        'notes'
        
    ];

  
     public function events(): HasMany{

        return $this->hasMany(Event::class);
     }


}
