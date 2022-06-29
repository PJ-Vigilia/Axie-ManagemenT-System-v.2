<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('user')){
            return view('user.transaction');
        }
    }

    public function fetchTransaction()
    {
        if(Auth::user()->hasRole('user')){
            $transaction = DB::table('users')
                            ->join('accounts', 'users.id', '=', 'accounts.user_id')
                            //->leftJoin('users', 'accounts.user_id', '=', 'user.id')
                            ->join('transactions', 'accounts.id', '=', 'transactions.account_id')
                            ->select('accounts.name as account_name', 'accounts.type as account_type', 'accounts.id as acc_id',
                                    DB::raw('max(transactions.transaction_date) as last_added'),
                                    DB::raw('sum(transactions.price) as totalPrice'))
                            ->where('users.id', Auth::id())
                            ->groupBy('account_name', 'account_type', 'acc_id')
                            ->orderBy('totalPrice', 'desc')
                            ->get();
            return response()->json(['transaction' => $transaction]);
        }
    }

    public function fetchAccountTransaction($id)
    {
        if(Auth::user()->hasRole('user')){
            $transaction = DB::table('transactions')
                            ->where('account_id', $id)
                            ->select('*')
                            ->get();
                        
            $totalTransaction = DB::table('transactions')
                            ->where('account_id', $id)
                            ->select(DB::raw('sum(slp_quantity) as totalSLP') , DB::raw('sum(price) as totalPrice'))
                            ->get();
            return response()->json([
                'transaction' => $transaction,
                'totalTransaction' => $totalTransaction,
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
                'slp_quantity' => 'required|integer',
                'total_price' => 'required',
                'transaction_date' => 'required|date',
                'account_name' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray()
                ]);
            }else{
                DB::table('transactions')->insert([
                    'account_id' => $request->account_name,
                    'slp_quantity' => $request->slp_quantity,
                    'transaction_date' => $request->transaction_date,
                    'price' => $request->total_price,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Transaction added successfully.'
                ]);
            }    
        }
    }

    public function storeAccountTransaction(Request $request)
    {
        if(Auth::user()->hasRole('user')){
            $validator = Validator::make($request->all(), [
                'slp_quantity' => 'required|integer',
                'total_price' => 'required',
                'transaction_date' => 'required|date',
                'account_id' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray()
                ]);
            }else{
                DB::table('transactions')->insert([
                    'account_id' => $request->account_id,
                    'slp_quantity' => $request->slp_quantity,
                    'transaction_date' => $request->transaction_date,
                    'price' => $request->total_price,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Transaction added successfully.'
                ]);
            }    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('user')){
            $transaction =DB::table('transactions')
                    ->where('id', $id)
                    ->select('*')
                    ->get();
            return response()->json([
                'transaction' => $transaction,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    public function updateAccountTransaction(Request $request)
    {
        if(Auth::user()->hasRole('user')){
            $validator = Validator::make($request->all(), [
                'slp_quantity' => 'required|integer',
                'total_price' => 'required',
                'transaction_date' => 'required|date',
                'transaction_id' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray()
                ]);
            }else{
                DB::table('transactions')
                ->where('id', $request->transaction_id)
                ->update([
                    'slp_quantity' => $request->slp_quantity,
                    'transaction_date' => $request->transaction_date,
                    'price' => $request->total_price,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Transaction updated successfully.'
                ]);
            }    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($account_id)
    {
        if(Auth::user()->hasRole('user')){
            DB::table('transactions')
            ->where('account_id', $account_id)
            ->delete();

            return response()->json([
                'message' => 'Transaction deleted successfully.'
            ]);
        }
    }

    public function deleteAccountTransaction($id)
    {
        if(Auth::user()->hasRole('user')){
            DB::table('transactions')
            ->where('id', $id)
            ->delete();

            return response()->json([
                'message' => 'Transaction deleted successfully.'
            ]);
        }
    }
}
