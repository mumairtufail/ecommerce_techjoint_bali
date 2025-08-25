<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'status',
        'flag',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Helper method to get available colors for this product
    public function getAvailableColors()
    {
        $colorIds = $this->variants()->whereNotNull('color_id')->pluck('color_id')->unique();
        return ProductColor::whereIn('id', $colorIds)->get();
    }

    // Helper method to get available sizes for this product
    public function getAvailableSizes()
    {
        $sizeIds = $this->variants()->whereNotNull('size_id')->pluck('size_id')->unique();
        return ProductSize::whereIn('id', $sizeIds)->get();
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function activeVariants()
    {
        return $this->hasMany(ProductVariant::class)->where('status', true);
    }

    public function inStockVariants()
    {
        return $this->hasMany(ProductVariant::class)->where('status', true)->where('stock', '>', 0);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->ordered();
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->primary();
    }

    public function getImageUrlAttribute()
    {
        // First try to get primary image from images relationship
        $primaryImage = $this->primaryImage;
        if ($primaryImage) {
            return $primaryImage->image_url;
        }
        
        // Fall back to legacy image field
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        
        return asset('images/default-product.jpg');
    }

    public function getMainImageAttribute()
    {
        return $this->image_url;
    }

    public function getTotalStockAttribute()
    {
        return $this->variants()->sum('stock');
    }

    public function getLowestPriceAttribute()
    {
        $lowestVariantPrice = $this->variants()->min('price_adjustment');
        return $this->price + ($lowestVariantPrice ?? 0);
    }

    public function getHighestPriceAttribute()
    {
        $highestVariantPrice = $this->variants()->max('price_adjustment');
        return $this->price + ($highestVariantPrice ?? 0);
    }

    public function getPriceRangeAttribute()
    {
        if ($this->variants()->count() === 0) {
            return '$' . number_format($this->price, 2);
        }

        $lowest = $this->lowest_price;
        $highest = $this->highest_price;

        if ($lowest == $highest) {
            return '$' . number_format($lowest, 2);
        }

        return '$' . number_format($lowest, 2) . ' - $' . number_format($highest, 2);
    }
}
