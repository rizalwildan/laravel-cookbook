<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

/**
 * App\Models\Recipes
 *
 * @property int $id
 * @property int $categories_id
 * @property string $recipe_name
 * @property string $description
 * @property string $image
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereCategoriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereRecipeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $prep_time
 * @property int $cook_time
 * @property int|null $servings
 * @property string|null $serving_size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereCookTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes wherePrepTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereServingSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipes whereServings($value)
 */
class Recipes extends Model
{
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('recipe_name')
            ->saveSlugsTo('slug');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredients::class, 'recipe_ingredients')
            ->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
