<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use \App\Settings;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','phone','address','city','state','zip','industry','email','password','active','settings'];

    protected $casts = ['settings'=>'json'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function name()
    {
      return $this->first_name.' '.$this->last_name;
    }

    public function contacts()
    {
      $accounts = \App\Account::where('user_id',$this->id)->lists('id');
      return \App\Contact::whereIn('account_id',$accounts)->get();

    }

    public function settings()
    {
        return new Settings($this->settings, $this);
    }


}
