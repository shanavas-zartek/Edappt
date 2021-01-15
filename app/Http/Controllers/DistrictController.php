<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Redirect;
class DistrictController extends Controller
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
          $data = District::join( 'countries', 'districts.country_id', '=', 'countries.id')
          -> join( 'states', 'districts.state_id', '=', 'states.id')
          ->select('districts.*','states.state_name','countries.country_name')
          -> orderBy('id','desc')->get();
            return view('country-states-city-districts.districts_list',compact('data'));
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
            if(($request->district_id !="") && ($request->district_id  > 0)){   //update
               

                $moniter_action = District::where('id', '=', $request->district_id )->update([
                   
                    'is_active'     =>$request->status,
                   
                    'updated_by'    => Auth::user()->id,
                   
           ]);

           
           $request->session()->flash('alert-success', 'District updated successfully');
       
           return Redirect::to('district');
            }else{

               
          
          
           $request->session()->flash('alert-success', 'Could not update District');
       
           return Redirect::to('district');
            }
          
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         $user = User::find(Auth::id());
         if($user->isAbleTo('settings')){
            $edit =District::join( 'countries', 'districts.country_id', '=', 'countries.id')
            -> join( 'states', 'districts.state_id', '=', 'states.id')
            ->select('districts.*','states.state_name','countries.country_name')
            ->where('districts.id',$id)->first();
        
         return view('country-states-city-districts.districts_create',compact('edit'));
         ;
     }else{
         abort(403,"You don't have permission to access this page");
     }
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
    }
}
