<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fonda extends Model
{
    //
    protected $table = 'fonda';

    public $timestamps = false;

    public $jsonName = 'fonda';

    protected $appends = [
        'comment_count', 'feature_image'
    ];

    protected $hidden = ['user', 'comments', 'images', 'dainties'];

    public function group()
    {
        return $this->belongsTo('App\Model\FondaGroup');
    }

    public function location()
    {
        return $this->hasOne('App\Model\Location');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function images()
    {
        return $this->hasMany('App\Model\ImageFonda');
    }

    public function dainties()
    {
        return $this->hasMany('App\Model\FondaDainty');
    }

    public function utilities()
    {
        return $this->hasMany('App\Model\FondaUtility');
    }

    public function culinaries()
    {
        return $this->hasMany('App\Model\FondaCulinary');
    }

    public function dainty()
    {
        return $this->belongsToMany('App\Model\Dainty', 'fonda_dainty', 'fonda_id', 'dainty_id');
    }
//
//    public function sales()
//    {
//        return $this->hasMany('App\Model\Sale');
//    }

    public function getCommentCountAttribute()
    {
        return count($this->comments);
    }

    public function getFeatureImageAttribute()
    {
        $images = $this->images;
        if (count($images) == 0)
            return null;
        $i = random_int(0, count($images) - 1);
        return $images[$i];
    }
//    public function getIsSaleAttribute()
//    {
//        return array_search(1, array_column($this->sales, 'is_active'));
//    }

    public static function dumm()
    {
        $fonda = Fonda::find(1);
        $fonda->location->makeHidden(['profile_id']);
        $fonda->group;
        return $fonda;
    }

}
