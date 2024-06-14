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
        'project_space_id',
        'provider_id',
        'product_id',
        'product_type',
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

    public function projectSpace(): BelongsTo
    {
        return $this->belongsTo(ProjectSpace::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'provider_id');
    }
}
