<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    use HasFactory;
    protected $table='advertisers';
    protected $fillable = ['fname','lname','email'];

    public function ads(){
        return $this->hasMany('App\Models\Ad','advertiser_id','id');
    }
}
