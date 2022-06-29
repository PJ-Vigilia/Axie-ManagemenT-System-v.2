<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->hasRole('user')){
            return view('user.home');
        }
    }
    public function fetchHome()
    {
        if(Auth::user()->hasRole('user')){
            $home = DB::table('users')
                    ->join('accounts', 'users.id', '=', 'accounts.user_id')
                    ->leftJoin('axies', 'accounts.id', '=', 'axies.account_id')
                    ->leftJoin('smooth_love_potions', 'accounts.id', '=', 'smooth_love_potions.account_id')
                    ->leftJoin('transactions', 'accounts.id', '=', 'transactions.account_id')
                    ->where('users.id', Auth::id())
                    ->select('accounts.name as acc_name', 'accounts.id as acc_id',
                            DB::raw('count(distinct(axies.id)) as totalAxie'),
                            DB::raw('sum(smooth_love_potions.quantity) as totalSLP'),
                            DB::raw('sum(transactions.price) as totalPrice'))
                    ->groupBy('acc_name', 'acc_id')
                    ->get();
            return response()->json(['home' => $home]);
        }
    }
}
