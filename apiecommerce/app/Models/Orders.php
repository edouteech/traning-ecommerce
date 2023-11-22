<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        "user_id",
        "state"
    ];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot('quantity');
    }
}
