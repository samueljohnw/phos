<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Chain;
use App\Account;

class ChainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($account_id)
    {
      $account = Account::find($account_id);
      $chains = Chain::where('account_id',$account_id)->get();

      if (\Gate::denies('show', $account)) {
        abort(403);
      }
      
      return view('chain.index',compact('chains','account'));
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

        Chain::create(['name'=>request()->name,'account_id'=>$account_id,'redirect'=>request()->redirect,'token'=>str_random(65)]);
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
        $chain = Chain::find($id);
        $account = Account::find($account_id);

        return view('chain.show',compact('chain','account'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($account_id, $id)
    {
        Chain::find($id)->delete();
        return redirect()->route('account.{account_id}.chain.index',['account_id'=>$account_id]);

    }
}
