<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
  protected $table = 'filetype';

  public $timestamps = false;

  protected $fillable = ['type'];


}
