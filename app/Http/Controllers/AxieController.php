<?php

namespace App\Http\Controllers;

use App\Models\Axie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AxieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('user')){
            return view('user.axie');
        }
    }

    public function fetchOwnAxie(){
        $axies = DB::table('users')
                ->join('accounts', 'users.id', '=', 'accounts.user_id')
                ->join('axies', 'accounts.id', '=', 'axies.account_id')
                ->where('users.id', Auth::id())
                ->select('accounts.id as account_id', 'accounts.name as account_name', 
                        'axies.id as axie_id','axies.axie_name', 'axies.axie_type', 'axies.axie_picture')
                ->get();
        return response()->json(['axies' => $axies]);
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
                'axie_picture' => 'required|image',
                'axie_name' => 'required|string',
                'axie_type' => 'required|string',
                'account_name' => 'required'
            ]);
            //return response()->json(['message' => 'A new axie added successfully']);
            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray(),
                ]);
            }else{
                $file = $request->file('axie_picture');
                $extension = $file->getClientOriginalExtension();
                $name = $file->getClientOriginalName(); 
                $filename = $name . time() . '.' . $extension;
                $file->move('images/axies/', $filename);

                DB::table('axies')->insert([
                    'account_id' => $request->account_name,
                    'axie_name' => $request->axie_name,
                    'axie_type' => $request->axie_type,
                    'axie_picture' => $filename,
                    'added_at' => now(),
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'A new axie added successfully',
                ]);
            }

            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Axie  $axie
     * @return \Illuminate\Http\Response
     */
    public function show(Axie $axie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Axie  $axie
     * @return \Illuminate\Http\Response
     */
    public function edit($axie_id)
    {
        if(Auth::user()->hasRole('user')){
            $axie = DB::table('users')
                ->join('accounts', 'users.id', '=', 'accounts.user_id')
                ->join('axies', 'accounts.id', '=', 'axies.account_id')
                ->where('axies.id', $axie_id)
                ->select('accounts.id as account_id', 'accounts.name as account_name', 
                        'axies.id as axie_id','axies.axie_name', 'axies.axie_type', 'axies.axie_picture')
                ->get();

            return response()->json([
                'axie' => $axie,
            ]);   
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Axie  $axie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $axie_id)
    {
        if(Auth::user()->hasRole('user')){
            $validator = Validator::make($request->all(), [
                'axie_name' => 'required|string',
                'axie_type' => 'required|string',
                'account_name' => 'required'
            ]);
            //return response()->json(['message' => 'A new axie added successfully']);
            if($validator->fails()){
                return response()->json([
                    'status' => 404,
                    'error' => $validator->errors()->toArray(),
                ]);
            }else{
                DB::table('axies')
                ->where('id', $axie_id)
                ->update([
                    'account_id' => $request->account_name,
                    'axie_name' => $request->axie_name,
                    'axie_type' => $request->axie_type,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'An axie updated successfully',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Axie  $axie
     * @return \Illuminate\Http\Response
     */
    public function destroy($axie_id)
    {
        if(Auth::user()->hasRole('user')){
            $axie = Axie::find($axie_id);
            $destination = "images/axies/". $axie->axie_picture;
            $name = $axie->axie_name;

            if(File::exists($destination)){
                File::delete($destination);
            }

            Axie::find($axie_id)->delete();

            return response()->json(['message' => $name .' deleted successfully']);
        }
    }
}
