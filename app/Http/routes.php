<?php

Route::post('chain/{token}',function($token){
  return redirect()->away(chain($token));
});



Route::group(['middleware' => 'web'], function () {

  Route::get('form/{token}',function($token){
    $chain = \App\Chain::where('token',$token)->first();
    if(is_null($chain))
      abort(503);
          
    return view('partials.form',['token'=>$token]);
  });

  Route::auth();

  Route::get('unsubscribe/{token}',['uses'=>'ContactsController@unsubscribe']);
  Route::delete('unsubscribe/{token}',['uses'=>'ContactsController@unsubscribe']);

  // Route::get('/',function(){
  //   return view('auth.login');
  // });

  Route::group(['middleware' => 'auth'], function () {
    Route::resource('account','AccountController');

    Route::resource('user','UserController');
    Route::group(['prefix' => 'account/{account_id}'], function(){
      Route::get('settings',['as'=>'account.{account_id}.settings','uses'=>'SettingsController@index']);
      Route::post('settings',['as'=>'account.{account_id}.settings','uses'=>'SettingsController@update']);
      Route::resource('contact','ContactsController');
      Route::resource('email','EmailController');
      Route::resource('chain','ChainController');
      Route::resource('message','MessageController');
    });
  });
});
