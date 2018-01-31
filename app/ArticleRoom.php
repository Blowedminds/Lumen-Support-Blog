<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleRoom extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'article_id'
    ];

    protected $hidden = [

    ];

    public function messages()
    {
        return $this->hasMany('App\RoomMessage', 'room_id');
    }

    public function scopeWithMessages($query)
    {
        return $query->with('messages');
    }
}
