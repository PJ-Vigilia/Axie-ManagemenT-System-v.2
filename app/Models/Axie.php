<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Axie extends Model
{
    use HasFactory;

    protected $table="axies";
    protected $fillable=[        
        'account_id',
        'axie_name',
        'axie_type',        
        'axie_picture',
        'added_at',
    ];
}
