<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Click extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url_id',
        'ip',
        'userAgent',
    ];

    /**
     * Get the Url that owns the click.
    */
    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class, 'url_id');
    }
}
