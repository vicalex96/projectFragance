<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productor extends Model
{
    protected $table ="vam_productor";
    protected $primaryKey = 'id_productor';
    public $timestamps = false;
}
