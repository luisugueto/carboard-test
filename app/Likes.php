<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'videos_id', 'user_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    protected $table = 'likes';
    
    public function video()
    {
        return $this->belongsTo('App\Videos', 'videos_id');
    }
}
