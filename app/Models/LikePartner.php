<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikePartner extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'partner_id'
    ];
}
