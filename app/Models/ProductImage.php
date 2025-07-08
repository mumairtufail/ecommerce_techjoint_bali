<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'image_path',
        'alt_text',
        'sort_order',
        'is_primary'
    ];
    
    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer'
    ];
    
    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    // Get the full URL for the image
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
    
    // Scope for primary images
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }
    
    // Scope for ordered images
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
