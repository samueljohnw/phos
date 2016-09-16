<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['subject','body', 'scheduled_at','contact_id','account_id'];
    protected $dates = ['scheduled_at'];

    public function account()
    {
      return $this->belongsTo('App\Account');
    }
    public function contact()
    {
      return $this->belongsTo('App\Contact');
    }
    public function status()
    {
      if($this->sent == 0)
        return 'Scheduled';

      return 'Sent';
    }    
}
