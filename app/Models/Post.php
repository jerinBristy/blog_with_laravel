<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['category', 'author'];

    protected $fillable = ['title','excerpt','body','category_id','slug'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search)=>
            $query->where(fn($query)=>
                $query->where('title','Like','%'.$search.'%')
                    ->orWhere('body','Like','%'.$search.'%')
            )
        );

        $query->when($filters['category'] ?? false, fn ($query, $category)=>
            $query->whereHas('category', fn($query)=>
                $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false, fn ($query, $author)=>
            $query->whereHas('author', fn($query)=>
            $query->where('username', $author)
            )
        );
    }
    public function category()
    {
        //hasone hasmany belongsto belongstomany
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
}

