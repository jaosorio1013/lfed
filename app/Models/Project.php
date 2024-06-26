<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'won_at',
        'lost_at',
        'started_at',
        'finished_at',
        'client_id',
    ];

    protected function casts(): array
    {
        return [
            'won_at' => 'datetime',
            'lost_at' => 'datetime',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'client_id');
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function spaces(): HasMany
    {
        return $this->hasMany(ProjectSpace::class, 'project_id');
    }
}
