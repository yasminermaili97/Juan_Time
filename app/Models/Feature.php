<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'watch_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function watch(){
        return $this->belongsTo(Watch::class);
    }
}
