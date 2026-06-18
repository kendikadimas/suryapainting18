<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'customer_name',
        'customer_phone',
        'product_name',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->order_code)) {
                $order->order_code = self::generateUniqueOrderCode();
            }
        });
    }

    public static function generateUniqueOrderCode()
    {
        do {
            // ORD- followed by 6 random alphanumeric uppercase characters (bin2hex(3) produces 6 characters)
            $code = 'ORD-' . strtoupper(bin2hex(random_bytes(3)));
        } while (self::where('order_code', $code)->exists());

        return $code;
    }

    public function timeline()
    {
        return $this->hasMany(OrderTimeline::class, 'order_id')->orderBy('created_at', 'desc');
    }
}
