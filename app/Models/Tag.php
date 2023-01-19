<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table='tags';
    protected $fillable=['name'];

    public function ads(){
        return $this->belongsToMany('App\Models\Ad','ad_tag','tag_id','ad_id')->withTimestamps();;
    }
}
