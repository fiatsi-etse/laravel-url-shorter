<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'originalUrl',
        'generatedUrl',
        'active',
        'expiryAt'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class, 'urlId');
        // return $this->hasMany(Click::class, 'urlId')->chaperone();
    }
}
