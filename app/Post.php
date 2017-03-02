<?php

namespace App;

use App\Services\FileManager\ImageHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    public $fillable = ['title', 'excerpt', 'content', 'content_original', 'user_id', 'category_id', 'status', 'cover'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected static $statuses = ['PUBLISHED', 'DRAFT', 'BLOCKED'];

    public static function getStatuses()
    {
        return self::$statuses;
    }

    public static function makeExcerpt($body)
    {
        $html = $body;
        $excerpt = trim(preg_replace('/\s\s+/', ' ', strip_tags($html)));
        
        return str_limit($excerpt, 200);
    }

    /**
     * attach tags by a array such as ['tag_id1', 'tag_id2, 'tag_id3 or new tag name', ...]
     * @param $tagNames
     * @return $this
     */
    public function attachTagsByTagNames($tagNames)
    {
        $tag_ids = [];
        foreach ($tagNames as $name) {
            $name = trim($name);
            if ($name == '') {
                continue;
            }

            $Tag = Tag::firstOrCreate(['name' => $name]);
            $tag_ids[] = $Tag->id;
        }
        
        $this->tags()->sync($tag_ids);
        
        return $this;
    }

    /**
     * Scope a query to only published post.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }

    public function getUpdatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }
    
    public function getCoverAttribute($value)
    {
        if ($value) {
            return ImageHandler::link($value);
        }
        
        return null;
    }
}
