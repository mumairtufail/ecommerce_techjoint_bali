<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'stock',
        'price_adjustment',
        'sku',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'price_adjustment' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function getFinalPriceAttribute()
    {
        return $this->product->price + $this->price_adjustment;
    }

    public function getVariantNameAttribute()
    {
        $parts = [];
        if ($this->size) {
            $parts[] = $this->size->name;
        }
        if ($this->color) {
            $parts[] = $this->color->name;
        }
        return implode(' - ', $parts);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}
