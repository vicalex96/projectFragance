<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    protected $table ="vam_proveedor";
    protected $primaryKey = 'id_proveedor';
    public $timestamps = false;
}
