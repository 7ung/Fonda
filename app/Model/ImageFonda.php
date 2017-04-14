<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:28 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ImageFonda extends Model
{
    protected $table = 'image_fonda';

    public $timestamps = false;

    public $jsonName = 'image_fonda';

    protected $appends = ['user_id', 'url', 'description', 'upload_date'];

    protected $hidden = ['img'];

    public function img()
    {
        return $this->belongsTo('App\Model\Image', 'image_id', 'id');
    }

    public function getUrlAttribute()
    {
        return $this->img->url;
    }

    public function getDescriptionAttribute()
    {
        return $this->img->description;
    }

    public function getUploadDateAttribute()
    {
        return $this->img->upload_date;
    }

    public function getUserIdAttribute()
    {
        return $this->img->user_id;
    }
}