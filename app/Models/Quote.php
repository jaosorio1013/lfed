<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'project_id',
        'identification',
        'subtotal',
        'discount',
        'percentage_utilidad',
        'percentage_administracion',
        'percentage_inprevistos',
        'percentage_retefuente',
        'valid_until',
        'sent_at',
        'approved_at',
        'rejected_at',
    ];

    protected function casts(): array
    {
        return [
            'valid_until' => 'datetime',
            'sent_at' => 'datetime',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_quotes', 'quote_id', 'product_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'product_quotes', 'quote_id', 'product_category_id');
    }

    public function products_project_provider(): BelongsToMany
    {
        return $this->belongsToMany(ProductProjectProvider::class, 'product_quotes', 'quote_id', 'product_project_provider_id');
    }

    public function getAuiPercentageAttribute()
    {
        return $this->percentage_administracion + $this->percentage_inprevistos + $this->percentage_inprevistos;
    }

    public function getAuiValueAttribute()
    {
        return $this->subtotal * ($this->aui_percentage * 0.01);
    }

    public function getTotalAttribute()
    {
        return $this->subtotal + $this->aui_value + $this->iva_value;
    }

    public function getIvaValueAttribute()
    {
        return $this->subtotal * (0.19);
    }
}
