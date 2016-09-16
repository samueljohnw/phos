<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChainLog extends Model
{
  protected $fillable = ['chain_id','contact_id','email_id'];
}
