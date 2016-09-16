<?php
namespace Phos;

use App\Chain;
use App\Contact;
use Carbon\Carbon;
use App\Email;
use Newsletter;
use App\Account;
use App\ChainLog;

class ContactHandler
{

  public function process($token)
  {
    $chain = Chain::where('token',$token)->with('messages')->firstOrFail();

    if(!$chain->isAccountActive())
      return redirect()->back();

    $this->reap($chain);
    return $chain->redirect;
  }

  public function checkIfContactExists($account_id,$email)
  {
    $contact = Contact::whereEmail(request()->email)->where('account_id',$account_id)->first();

    if($contact)
      return true;

    return false;
  }

  public function reap($chain)
  {

    if($this->checkIfContactExists($chain->account_id,request()->email))
      return;

    $account = Account::find($chain->account_id);

    $contact = Contact::create(
                            [
                              'account_id'=>$chain->account_id,
                              'first_name'=>request()->first_name,
                              'last_name'=>request()->last_name,
                              'email'=>request()->email,
                              'token'=>  str_random(25)
                            ]);

    if($account->settings()->has('emailProvider'))
    {
      config(['laravel-newsletter.apiKey'=>$account->settings()->api_key]);
      config(['laravel-newsletter.lists.subscribers.id'=>$account->settings()->listID]);
      Newsletter::subscribe(request()->email, ['FNAME'=>request()->first_name, 'LNAME'=>request()->last_name], 'subscribers');
    }

    foreach($chain->messages as $message)
    {
      if(is_null($message->scheduled_at))
        $scheduled_at = Carbon::now()->addDays($message->days)->format('Y-m-d').' '.$message->time;

      $email = Email::create(
        [
          'subject'=>$message->subject,
          'body'=>$message->body,
          'scheduled_at'=>$scheduled_at,
          'contact_id'=>$contact->id,
          'account_id'=>$chain->account_id
        ]);
      ChainLog::create(['chain_id'=>$chain->id,'contact_id'=>$contact->id,'email_id'=>$email->id]);
    }

  }
}
