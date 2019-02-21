<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

/**
 * App\Models\Categories
 *
 * @property int $id
 * @property string $category_name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Categories extends Model
{
    //
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category_name')
            ->saveSlugsTo('slug');
    }

    public function recipe()
    {
        return $this->hasMany(Recipes::class);
    }

}
