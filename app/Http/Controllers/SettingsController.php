<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Account;

class SettingsController extends Controller
{
    public function index($account_id)
    {
      $account = Account::find($account_id);
      if(is_null($account->settings))
      {
        $account->settings = [];
        $account->save();
      }
      return view('account.settings',compact('account'));
    }

    public function update($account_id)
    {
      $account = Account::find($account_id);
      $account->settings()->set('emailProvider',request()->emailProvider);
      $account->settings()->set('listID',request()->listID);
      $account->settings()->set('api_key',request()->api_key);
      return view('account.settings',compact('account'));
    }
}
