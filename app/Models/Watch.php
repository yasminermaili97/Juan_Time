<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'model',
        'brand',
        'type_id',
        'strap_id',
        'year_edition',
        'ean',
        'price'
    ];

    protected $hidden = ['type_id', 'strap_id'];

    function feature(){
        return $this->hasMany(Feature::class);
    }

    function strap(){
         return $this->belongsTo(Strap::class);
    }

    function type(){
        return $this->belongsTo(Type::class);
    }

}
