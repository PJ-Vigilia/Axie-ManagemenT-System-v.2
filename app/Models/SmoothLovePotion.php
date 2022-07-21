<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmoothLovePotion extends Model
{
    use HasFactory;

    protected $table="smooth_love_potions";
    protected $fillable=[
        'account_id',
        'quantity',
        'added_at',
    ];
}
