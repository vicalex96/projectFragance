<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class escala extends Model
{
    protected $table ="vam_escala_valorada";
    protected $primaryKey = array('id_productor','id_escala');
    public $timestamps = false;
}
