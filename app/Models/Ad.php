<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $table='ads';
    protected $fillable = ['title','type','description','start_date','category_id','advertiser_id'];

    public function advertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','ad_tag','ad_id','tag_id')->withTimestamps();
    }
}
