<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    protected $table = "urls";

    protected $fillable = [
    	"link","hash","count"
    ];

   public $timestamps = false;
}
