<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'original_url',
        'generated_url',
        'active',
        'expiry_at',
        'user_id'
    ];

    /**
     * Get the clicks for Url.
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class, 'url_id');
        // return $this->hasMany(Click::class, 'url_id')->chaperone();
    }

    /**
     * Get the User that owns the Url.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
