<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Redirect;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
          $data = Country::orderBy('id','desc')->get();
            return view('country-states-city-districts.country_list',compact('data'));
        }else{
            abort(403,"You don't have permission to access this page");
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
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
            if(($request->country_id !="") && ($request->country_id > 0)){   //update
               

                $moniter_action = Country::where('id', '=', $request->country_id)->update([
                   
                    'is_active'     =>$request->status,
                   
                    'updated_by'    => Auth::user()->id,
                   
           ]);

           
           $request->session()->flash('alert-success', 'Country updated successfully');
       
           return Redirect::to('country');
            }else{

               
          
          
           $request->session()->flash('alert-success', 'Could not update country');
       
           return Redirect::to('country');
            }
          
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
        $edit =  Country::where('id',$id)->first();
        return view('country-states-city-districts.country_create',compact('edit'));
        ;
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
}
