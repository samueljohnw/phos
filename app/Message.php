<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = ['chain_id','subject','body','scheduled_at','days','time'];
  protected $dates = ['created_at', 'updated_at', 'scheduled_at'];

  public function chain()
  {
    return $this->belongsTo('App\Chain');
  }

}
