<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Products extends Model
{
    protected $table = "order_products";
    protected $fillable = [
        "order_id",
        "product_id",
        "quantity"
    ];
    use HasFactory;

    // Define Relationship

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
