<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'nomor_surat',
        'cabang',
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

    public function getFormattedNomorPlatAttribute(): string
    {
        if (!$this->nomor_plat) {
            return '';
        }

        $clean = preg_replace('/[^A-Za-z0-9]/', '', $this->nomor_plat);
        $clean = strtoupper($clean);

        if (preg_match('/^([A-Z]{0,2})(\d{0,4})([A-Z]{0,3})$/', $clean, $m)) {
            $parts = array_filter([$m[1] ?? '', $m[2] ?? '', $m[3] ?? ''], fn($v) => $v !== '');
            return implode(' ', $parts);
        }

        return $this->nomor_plat;
    }
}
