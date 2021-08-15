<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    // связь многие ко многим с таблицей products
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
