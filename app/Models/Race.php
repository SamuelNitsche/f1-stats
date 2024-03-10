<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LogicException;

class Race extends Model
{
    use HasFactory;

    protected $casts = [
        'starts_at' => 'datetime',
        'fp1_starts_at' => 'datetime',
        'fp2_starts_at' => 'datetime',
        'fp3_starts_at' => 'datetime',
        'qualifying_starts_at' => 'datetime',
        'sprint_starts_at' => 'datetime',
    ];

    public function circuit(): BelongsTo
    {
        return $this->belongsTo(Circuit::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(RaceResult::class);
    }

    /**
     * @throws LogicException
     */
    public function isSprintRace(): bool
    {
        if ($this->starts_at === null) {
            throw new LogicException('Cannot determine if race is a sprint. No session start times available.');
        }

        return $this->sprint_starts_at !== null;
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('starts_at', '>', now())->orderBy('starts_at');
    }

    public function hasFinished(): bool
    {
        return $this->starts_at->addHours(2)->isPast();
    }
}
