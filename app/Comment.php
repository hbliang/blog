<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['status', 'user_id', 'post_id', 'parent_id', 'content', 'content_original'];
    
    protected static $statuses = [
        'PUBLISHED', 'BLOCKED'
    ];

    public static function getStatuses()
    {
        return self::$statuses;
    }

    public function toggleStatus()
    {
        $theOtherStatus = $this->getTheOtherStatusAttribute();

        $this->status = $theOtherStatus;

        return $this;
    }

    public function getTheOtherStatusAttribute()
    {
        $statues = self::$statuses;

        return implode('', array_diff($statues, [$this->status]));
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
    
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }
    
    public function getUpdatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }
}
