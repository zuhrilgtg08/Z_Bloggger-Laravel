<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Traits\Uuid as Traits;
use App\Models\RatingComments;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, Sluggable, Traits, SoftDeletes;
    protected $guarded = ['id'];
    protected $with = ['category', 'author', 'rating_comments'];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rating_comments()
    {
        return $this->hasMany(RatingComments::class, 'post_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['keyword'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author)
            => $query->whereHas(
                'author',
                fn ($query)
                => $query->where('username', $author)
            )
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
