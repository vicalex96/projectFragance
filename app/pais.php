<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pais extends Model
{
    protected $table ="vam_pais";
    protected $primaryKey = 'id_pais';
    public $timestamps = false;
}
