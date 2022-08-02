<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $guarded = [];

    public function detailTransaksi()
    {
        return $this->hasMany(Detailorder::class, 'order_id', 'id');
    }
    public function statusOrder()
    {
        return $this->belongsTo(Orderstatus::class, 'status_order_id', 'id');
    }
}


