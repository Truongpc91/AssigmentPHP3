<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'catelogue_id',
        'slug',
        'sku',
        'image_thumbnail',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'material',
        'user_manual',
        'view',
    ];

    protected $casts = [
        'is_active'     => 'boolean',
        'is_hot_deal'   => 'boolean',
        'is_good_deal'  => 'boolean',
        'is_new'        => 'boolean',
        'is_show_home'  => 'boolean',
    ];

    public function catelogue()
    {
        //Product belong to catalogues
        return $this->belongsTo(Catelogue::class);
    }

    public function tags()
    {
        //Product belong to catalogues
        return $this->belongsToMany(Tag::class);
    }

    public function galleries()
    {
        //Product belong to catalogues
        return $this->hasMany(ProductGallery::class);
    }

    public function variants()
    {
        //Product belong to catalogues
        return $this->hasMany(ProductVariant::class);
    }
}
