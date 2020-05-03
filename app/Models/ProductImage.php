<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_images';

    /**
     * @var string[]
     */
    protected $fillable = [
        'product_id', 'thumbnail', 'full'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'product_id' => 'integer'
    ];

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
