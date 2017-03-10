<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnLikes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'number', 'videos_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    protected $table = 'un_likes';
    
    public function video()
    {
        return $this->belongsTo('App\Videos', 'videos_id');
    }
}
