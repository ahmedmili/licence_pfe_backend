<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Panier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $timestamps = false;
    protected $fillable = ['title', 'description', 'ancien_prix', 'nouveau_prix', 'date_dispo', 'quantite', 'image', 'categorie'];

    // public function setDateDispoAttribute($value)
    // {
    //     $this->attributes['date_dispo'] = Carbon::createFromFormat('m/d/Y', $value)->format('-m-d');
    // }
}
