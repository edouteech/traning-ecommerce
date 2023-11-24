<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        "name",
        "description",
        "prix",
        "id_category"
    ];

    //Define relationship

    
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_category', 'id');
    }

}
