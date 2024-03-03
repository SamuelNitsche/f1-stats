<?php

declare(strict_types=1);

namespace App\Models;

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
        if (null === $this->starts_at) {
            throw new LogicException('Cannot determine if race is a sprint. No session start times available.');
        }

        return null !== $this->sprint_starts_at;
    }
}
