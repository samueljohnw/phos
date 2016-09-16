<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Settings;

class Account extends Model
{
  protected $fillable = ['user_id','first_name','last_name', 'email', 'password','company_name','logo','settings'];
  protected $casts = ['settings'=>'json'];

  public function name()
  {
    return $this->first_name.' '.$this->last_name;
  }

  public function contacts()
  {
    return $this->hasMany('App\Contact');
  }

  public function chains()
  {
    return $this->hasMany('App\Chain');
  }

  public function settings()
  {
      return new Settings($this->settings, $this);
  }

}
