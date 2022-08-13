<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['name','image','description','price','price_awal','weigth','stok','unit'];
}
