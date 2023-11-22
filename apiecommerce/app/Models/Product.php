<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
            ->withPivot('quantity');
    }
}
