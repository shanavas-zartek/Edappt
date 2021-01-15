<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Redirect;
class CityController extends Controller
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
          $data = City::join( 'countries', 'cities.country_id', '=', 'countries.id')
          -> join( 'states', 'cities.state_id', '=', 'states.id')
          -> join( 'districts', 'cities.district_id', '=', 'districts.id')
          ->select('cities.*','districts.district_name','states.state_name','countries.country_name')
          -> orderBy('districts.id','desc')->get();
            return view('country-states-city-districts.city_list',compact('data'));
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
            if(($request->city_id !="") && ($request->city_id  > 0)){   //update
               

                $moniter_action = City::where('id', '=', $request->city_id )->update([
                   
                    'is_active'     =>$request->status,
                   
                    'updated_by'    => Auth::user()->id,
                   
           ]);

           
           $request->session()->flash('alert-success', 'City updated successfully');
       
           return Redirect::to('city');
            }else{

               
          
          
           $request->session()->flash('alert-success', 'Could not update City');
       
           return Redirect::to('city');
            }
          
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         $user = User::find(Auth::id());
         if($user->isAbleTo('settings')){
            $edit =City::join( 'countries', 'cities.country_id', '=', 'countries.id')
            -> join( 'states', 'cities.state_id', '=', 'states.id')
            -> join( 'districts', 'cities.district_id', '=', 'districts.id')
            ->select('cities.*','districts.district_name','states.state_name','countries.country_name')
            ->where('cities.id',$id)->first();
        
         return view('country-states-city-districts.city_create',compact('edit'));
         ;
     }else{
         abort(403,"You don't have permission to access this page");
     }
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
