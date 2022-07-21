<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AxieAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('user')){
            return view('user.account');
        }
    }
    public function account($id){
        if(Auth::user()->hasRole('user')){
            $account_id = $id;
            return view('user.viewAccount', compact('account_id'));
        }
    }

    public function fetchOwnAccounts()
    {
        if(Auth::user()->hasRole('user')){
            $accounts = DB::table('accounts')
                        ->where('user_id', Auth::id())
                        ->select('*')
                        ->get();
            return response()->json([
                'accounts' => $accounts
            ]);
        }
    }

    public function fetchAccount($id){
        if(Auth::user()->hasRole('user')){
            $account = DB::table('accounts')
                    ->where('id', $id)
                    ->select('*')
                    ->get();
            return response()->json([
                'account' => $account
            ]);
        }
    }

    public function fetchAccountName(){
        if(Auth::user()->hasRole('user')){
            $accounts = DB::table('accounts')
                    ->where('user_id', Auth::id())
                    ->select('name', 'id')
                    ->get();
            return response()->json([
                'accounts' => $accounts
            ]);
        }
    }

    public function fetchName($id){
        if(Auth::user()->hasRole('user')){
            $account =Account::find($id);
            $name = $account->name;
            return response()->json([
                'name' => $name
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
                'account_name' =>'required|string|max:150',
                'account_type' =>'required|string|max:8',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'errors' => $validator->errors()->toArray(),
                ]);
            }else{
                $account = Account::create([
                    'user_id' => Auth::id(),
                    'name' => $request->account_name,
                    'type' => $request->account_type,
                    'created_at' => now(),
                ]);

                return response()->json([
                    'message' => $account->name . ' has been added successfully.',
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit($account_id)
    {
        if(Auth::user()->hasRole('user')){
            $account = DB::table('accounts')
                    ->where('id', $account_id )
                    ->select('*')
                    ->get();
            return response()->json(['account' => $account]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $account_id)
    {
        if(Auth::user()->hasRole('user')){ 
            
            $validator = Validator::make($request->all(), [
                'account_name' => 'required|string|max:200',
                'account_type' => 'required|string|max:8',
            ]);
            //return response()->json(['message' => " has been updated successfully."]);           
            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'errors' => $validator->errors()->toArray(),
                ]);
            }else{
                $name = $request->account_name;
                DB::table('accounts')
                ->where('id', $account_id)
                ->update([
                    'name' => $request->account_name,
                    'type' => $request->account_type,
                    'updated_at' => now(),
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $name ." has been updated successfully."
                ]);
            }    
                    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy($account_id)
    {
        if(Auth::user()->hasRole('user')){
            Account::find($account_id)->delete();
            

            return response()->json([
                'message' => "You deleted an account successfully."
            ]);
        }
    }
    public function deleteAccount(Request $request)
    {
        if(Auth::user()->hasRole('user')){
            $validator = Validator::make($request->all(), [
                'account_id' => 'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray()
                ]);
            }else{
                Account::find($request->account_id)->delete();
                return redirect()->route('account.index');
            }
            
        }
    }
}
