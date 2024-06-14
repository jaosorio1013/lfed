<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductProjectProvider extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'project_id',
        'provider_id',
        'product_id',
        'product_category_id',
        'has_materiales',
        'has_transporte',
        'has_suministro',
        'has_instalacion',
        'quantity',
        'price_per_unit',
        'total',
        'valid_until',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'provider_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getProductNameAttribute(): string
    {
        return $this->product->name ?? '';
    }

    public function getProductDescriptionAttribute(): string
    {
        return $this->product->description ?? '';
    }

    public function getCategoryNameAttribute(): string
    {
        return $this->category->name ?? '';
    }
}
