<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Account;
use Phos\ImageHandler;
use Carbon\Carbon;
use DB;
use Gate;

class AccountController extends Controller
{
    public function index()
    {
      $accounts = Account::where('user_id',auth()->user()->id)->get();
      return view('account.index',compact('accounts'));
    }

    public function show($id)
    {

      $account = Account::find($id);

      if (Gate::denies('show', $account)) {
        abort(403);
      }

      $chartDatas = $account->contacts()->select([
          DB::raw('DATE(created_at) AS date'),
          DB::raw('COUNT(id) AS count'),
       ])
       ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
       ->groupBy('date')
       ->orderBy('date', 'ASC')
       ->get()
       ->toArray();
       $chartDataByDay = array();

      foreach($chartDatas as $data) {
          $chartDataByDay[$data['date']] = $data['count'];
      }

      $date = new Carbon;
      for($i = 0; $i < 30; $i++) {
          $dateString = $date->format('Y-m-d');
          if(!isset($chartDataByDay[ $dateString ])) {
              $chartDataByDay[$dateString] = 0;
          }
          $date->subDay();
      }

      krsort($chartDataByDay);

      return view('account.show',compact('account','chartDataByDay'));
    }

    public function update(Request $request, $id)
    {

        $account = Account::find($id);

        if (Gate::denies('update', $account)) {
          abort(403);
        }

        if (request()->ajax()){
          $account->active = request()->active;
          $account->save();
          return;
        }
        $account->first_name = request()->first_name;
        $account->last_name = request()->last_name;
        $account->company_name = request()->company_name;
        $account->email = request()->email;
        if ($request->hasFile('logo')){
          $account->logo = (new ImageHandler)->process(request()->logo);
        }
        $account->save();
        return back();

    }

    public function store()
    {

      $logo = '';
      if (request()->hasFile('logo')){
        $logo = (new ImageHandler)->process(request()->logo);
      }      
        Account::create(
          [
            'user_id' => auth()->user()->id,
            'first_name'=>request()->first_name,
            'last_name'=>request()->last_name,
            'email'=>request()->email,
            'company_name' =>request()->company_name,
            'logo' =>$logo,
            'settings'=>[]
          ]);
        return back();
    }
}
