<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected function casts()
    {
        return [
            'valid_until' => 'datetime',
            'sent_at' => 'datetime',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }
}
