<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use App\Account;
use Newsletter;
use Gate;

class ContactsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($account_id)
    {
      $account = Account::find($account_id);
      $contacts = Contact::withTrashed()->where('account_id',$account->id)->get();
      return view('contact.index',compact('contacts','account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($account_id)
    {
        $contactExists = Contact::where('email',request()->email)->where('account_id',$account_id)->first();
        $account = Account::find($account_id);

        if(is_object($contactExists) && $contactExists->exists)
          return back()->with('status','Contact Already Exists');

        Contact::create(
          [
            'first_name'  =>  request()->first_name,
            'last_name'   =>  request()->last_name,
            'email'       =>  request()->email,
            'account_id'     =>  $account_id,
            'token'       =>  str_random(25)
          ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($account_id, $id)
    {
        $account = Account::find($account_id);
        $contact = Contact::find($id);
        
        if($contact->account_id != $account->id)
          abort(403);

        return view('contact.show',compact('contact','account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($account_id, $id)
    {
      $contact = Contact::find($id);
      $contact->first_name = request()->input('first_name');
      $contact->last_name = request()->input('last_name');
      $contact->email = request()->input('email');
      $contact->save();
      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($account_id, $id)
    {
      Contact::find($id)->delete();
      return redirect()->route('account.{account_id}.contact.index',['account_id'=>$account_id])->with('status','Contact Deleted');
    }

    public function unsubscribe($token)
    {
      if(session('status'))
        return view('public.unsubscribe');

      $contact = Contact::where('token',$token)->first();

      if (request()->isMethod('delete')) {
        $contact->delete();
        return back()->with('status','You\'ve been unsubscribed');
      }

      if(is_object($contact) && $contact->exists)
        return view('public.unsubscribe');

      abort(404);

    }
}
