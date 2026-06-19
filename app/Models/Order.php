<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'nomor_surat',
        'customer_name',
        'customer_phone',
        'nomor_plat',
        'tipe_motor',
        'detail_motor',
        'product_name',
        'status',
    ];

    public function timeline()
    {
        return $this->hasMany(OrderTimeline::class, 'order_id')->orderBy('created_at', 'desc');
    }
}
