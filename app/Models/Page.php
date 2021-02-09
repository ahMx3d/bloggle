<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    // SEO Friendly Package Trait.
    use Sluggable;

    protected $table = 'posts';
    protected $guarded = [];

    /**
     * The Sluggable Trait Method Implementation.
     *
     * @return array
     */
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Scope a query to only select specific attributes of pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSelection($query)
    {
        return $query->select(
            'id',
            'title',
            'description',
            'slug'
        );
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope a query to only include type-page pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTypePage($query)
    {
        return $query->where('post_type', 'page');
    }

    /**
     * The Page Category Relationship
     * Each page belongs to a category.
     *
     * @return object
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * The Page User Relationship
     * Each page belongs to a user.
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * The Page Media Relationship
     * Each page has many media.
     *
     * @return object
     */
    public function media()
    {
        return $this->hasMany(PostMedia::class, 'post_id', 'id');
    }
}
