<?php

namespace App\Http\Controllers;

use App\States;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Redirect;
class StatesController extends Controller
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
          $data = States::join( 'countries', 'states.country_id', '=', 'countries.id')
          ->select('states.*','countries.country_name')
          -> orderBy('id','desc')->get();
            return view('country-states-city-districts.states_list',compact('data'));
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
            if(($request->state_id !="") && ($request->state_id > 0)){   //update
               

                $moniter_action = States::where('id', '=', $request->state_id)->update([
                   
                    'is_active'     =>$request->status,
                   
                    'updated_by'    => Auth::user()->id,
                   
           ]);

           
           $request->session()->flash('alert-success', 'State updated successfully');
       
           return Redirect::to('states');
            }else{

               
          
          
           $request->session()->flash('alert-success', 'Could not update State');
       
           return Redirect::to('states');
            }
          
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\States  $states
     * @return \Illuminate\Http\Response
     */
    public function show(States $states)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\States  $states
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         $user = User::find(Auth::id());
         if($user->isAbleTo('settings')){
            $edit = States::join( 'countries', 'states.country_id', '=', 'countries.id')
            ->select('states.*','countries.country_name')
            ->where('states.id',$id)->first();
        
         return view('country-states-city-districts.states_create',compact('edit'));
         ;
     }else{
         abort(403,"You don't have permission to access this page");
     }
     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\States  $states
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, States $states)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\States  $states
     * @return \Illuminate\Http\Response
     */
    public function destroy(States $states)
    {
        //
    }
}
