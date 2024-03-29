<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\RegProcess;
use App\Models\User;

class AccountController extends Controller
{
    /**
    * Return the account registration form view.
    *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AccountPages.accountForm');
    }

    /**
     * Show the view with account info.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $acc=auth()->user()->business->account;
        $user=auth()->user();
        return view('AccountPages.accountInfo')
                                                ->with('acc',$acc)
                                                ->with('user',$user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'bank'=>'bail|required|string',
            'title'=>'bail|required|string',
            'type'=>'bail|required|string',
            'number'=>'bail|required|integer|unique:accounts,number',
            'balance'=>'bail|required|integer|min:1000',
            'jointAcc'=>'bail|required|alpha',
            'terms'=>'bail|required|boolean',
        ]);
        $userId=auth()->user()->id;
        $bus=User::find($userId)->business;
        // Find a record with business_id if not found create one.
        $bus->account()->firstOrCreate(
            ['business_id'=>$bus->id],
            [
                'bank'=>$request->bank,
                'acc_title'=>$request->title,
                'type'=>$request->type,
                'number'=>$request->number,
                'balance'=>$request->balance,
                'jointAcc'=>$request->jointAcc,
                'terms'=>$request->terms,

            ]);
        $bus->refresh();
        // Update the registration stage of the user.
        RegProcess::where('user_id','=',$userId)->update(['stage'=>2]);
        return redirect()->route('dashboard.index');
    }

}
