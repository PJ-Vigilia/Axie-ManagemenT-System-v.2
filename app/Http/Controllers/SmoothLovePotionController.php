<?php

namespace App\Http\Controllers;

use App\Models\SmoothLovePotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SmoothLovePotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('user')){
            return view('user.slp');
        }
    }

    public function fetchSLP()
    {
        if(Auth::user()->hasRole('user')){
            $slp = DB::table('users')
                ->join('accounts', 'users.id', '=', 'accounts.user_id')
                ->join('smooth_love_potions', 'accounts.id', '=', 'smooth_love_potions.account_id')
                ->select('accounts.name as account_name', 'accounts.type as account_type', 'accounts.id as acc_id',
                        DB::raw('max(smooth_love_potions.added_at) as last_added'),
                        DB::raw('sum(smooth_love_potions.quantity) as totalSLP'))
                ->where('users.id', Auth::id())
                ->groupBy('account_name', 'account_type', 'acc_id')
                ->orderBy('totalSLP', 'desc')
                ->get();
            return response()->json(['slp' => $slp]);
        }
    }

    public function fetchAccountSLP($account_id)
    {
        if(Auth::user()->hasRole('user')){
            $slp = DB::table('smooth_love_potions')
                    ->where('account_id', $account_id)
                    ->select('quantity', 'added_at', 'id')
                    ->orderBy('added_at', 'desc')
                    ->get();
            $totalSLP = DB::table('smooth_love_potions')
                    ->where('account_id', $account_id)
                    ->sum('quantity');
                    //->select(DB::raw('sum(quantity) as totalSLP'))                    
                    //->get();  
                
           
            return response()->json([
                'slp' => $slp,
                'totalSLP' => $totalSLP,
            ]);
        }
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
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('user')){
            $validator = Validator::make($request->all(), [
                'quantity' => 'required|integer',
                'account_name' => 'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray()
                ]);
            }else{
                DB::table('smooth_love_potions')->insert([
                    'account_id' => $request->account_name,
                    'quantity' => $request->quantity,
                    'added_at' => now(),
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'SLP added successfully.'
                ]);
            }            
        }
    }

    public function storeAccountSLP(Request $request)
    {
        if(Auth::user()->hasRole('user')){
            $validator = Validator::make($request->all(), [
                'quantity' => 'required|integer',
                'account_id' => 'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray()
                ]);
            }else{
                DB::table('smooth_love_potions')->insert([
                    'account_id' => $request->account_id,
                    'quantity' => $request->quantity,
                    'added_at' => now(),
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'SLP added successfully.'
                ]);
            }            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmoothLovePotion  $smoothLovePotion
     * @return \Illuminate\Http\Response
     */
    public function show(SmoothLovePotion $smoothLovePotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmoothLovePotion  $smoothLovePotion
     * @return \Illuminate\Http\Response
     */
    public function edit(SmoothLovePotion $smoothLovePotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmoothLovePotion  $smoothLovePotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmoothLovePotion $smoothLovePotion)
    {
        //
    }

    public function updateAccountSLP(Request $request, $id)
    {
        if(Auth::user()->hasRole('user')){
            $validator = Validator::make($request->all(), [
                'quantity' => 'required|integer'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray()
                ]);
            }else{
                DB::table('smooth_love_potions')
                ->where('id', $id)
                ->update([
                    'quantity' => $request->quantity,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'SLP updated successfully.'
                ]);
            } 
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmoothLovePotion  $smoothLovePotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmoothLovePotion $smoothLovePotion)
    {
        //
    }

    public function deleteSLPAccount($account_id)
    {
        if(Auth::user()->hasRole('user')){
            DB::table('smooth_love_potions')
            ->where('account_id', $account_id)
            ->delete();

            return response()->json([
                'message' => 'SLP deleted successfully.'
            ]);
        }
    }

    public function deleteAccountSLP($id)
    {
        if(Auth::user()->hasRole('user')){
            DB::table('smooth_love_potions')
            ->where('id', $id)
            ->delete();

            return response()->json([
                'message' => 'SLP deleted successfully.'
            ]);
        }
    }
}
