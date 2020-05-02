<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'featured',
        'menu',
        'image'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'parent_id' => 'integer',
        'featured' => 'boolean',
        'menu' => 'boolean'
    ];

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
