<?php

namespace App\Models;

use App\Models\Box;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Command extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'price',
        'status'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function boxs()
    {
        return $this->belongsToMany(Box::class)->withPivot('quantity');
    }

    public function rates()
    {
        return $this->belongsToMany(Rating::class);
    }
}
