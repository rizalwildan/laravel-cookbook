<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

/**
 * App\Models\Ingredients
 *
 * @property int $id
 * @property string $ingredient_name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients whereIngredientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $notes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredients whereNotes($value)
 */
class Ingredients extends Model
{
    //
    use HasSlug, Eloquence;

    protected $searchableColumns = ['ingredient_name'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('ingredient_name')
            ->saveSlugsTo('slug');
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipes::class);
    }
}
