<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTimeline extends Model
{
    protected $table = 'order_timeline';

    protected $fillable = [
        'order_id',
        'title',
        'description',
        'image_path',
        'status',
    ];

    protected $appends = ['image_url'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }
}
