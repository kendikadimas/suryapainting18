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

    /**
     * Returns true when the stored file is HEIC/HEIF (not renderable by browsers).
     */
    public function getIsHeicAttribute(): bool
    {
        if (!$this->image_path) {
            return false;
        }
        $ext = strtolower(pathinfo($this->image_path, PATHINFO_EXTENSION));
        return in_array($ext, ['heic', 'heif']);
    }
}
