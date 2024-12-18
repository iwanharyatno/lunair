<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'img_url'
    ];

    public function image() {
        return $this->hasOne(Image::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
}
