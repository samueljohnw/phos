<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name','last_name','email','account_id','token'];
    protected $dates = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($contact) {
            $contact->emails()->delete();
        });
    }

    public function emails()
    {
      return $this->hasMany('App\Email');
    }
    public function name()
    {
      return $this->first_name.' '.$this->last_name;
    }
}
