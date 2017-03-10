<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'url', 'title', 'description', 'category'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    protected $table = 'videos';
    
    public function likes()
    {
        return $this->hasMany('App\Likes');
    }
    
    public function unLikes()
    {
        return $this->hasMany('App\UnLikes');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}
