<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chain extends Model
{
    protected $fillable = ['name','account_id','token','redirect'];

    public function messages()
    {
      return $this->hasMany('App\Message');
    }
    
    public function isAccountActive()
    {
      return $this->account->active;
    }

    public function account()
    {
      return $this->belongsTo('App\Account');
    }

    public function contacts()
    {
      return $this->hasMany('App\ChainLog');
    }
}
