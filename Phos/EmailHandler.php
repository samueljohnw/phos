<?php
namespace Phos;

use App\Email;
use Carbon\Carbon;
use Mail;

class EmailHandler
{

  public function process()
  {
    $emails = Email::all();

    foreach($emails as $email)
    {
      if($email->sent == 0 && $email->scheduled_at <= Carbon::now())
        $this->sendEmail($email);
    }
  }

  function sendEmail($email)
  {

    Mail::send(['html'=>'template.emails.basic'],['account'=>$email->account,'body'=>$email->body,'token'=>$email->contact->token], function ($m) use($email) {
        $m->from($email->account->email, $email->account->name());
        $m->to($email->contact->email, $email->contact->name())->subject($email->subject);
    });
    $email->sent = true;
    $email->save();
  }

}
