<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    protected $table = 'city';
    protected $primaryKey = 'id';
    protected $fillable = array(
        'name'
    );

    public $timestamps = false;
}
