<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQuote extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'project_id',
        'quote_id',
        'product_project_provider_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function productProjectProvider(): BelongsTo
    {
        return $this->belongsTo(ProductProjectProvider::class);
    }
}
