<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable=[
        'file'
    ];

    protected $uploads='/images/';
//getcoloumnnameAttribute
    public function getFileAttribute($ahmed){
        return $this->uploads.$ahmed;
    }
}
