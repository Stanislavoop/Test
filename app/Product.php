<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // связь один ко многим с таблицей images
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    // связь многие к одному с таблицей category
    public function category(){
        return $this->belongsTo(Category::class);
    }
    // связь многие ко многим с таблицей category
    public function baskets() {
        return $this->belongsToMany(Basket::class)->withPivot('quantity');
    }
}
