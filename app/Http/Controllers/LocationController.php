<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;
class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = DB::table("countries")->where('is_active', 1)->pluck("country_name","id");
    }
    public function getStateList($id)
    {
        $states = DB::table("states")
        ->where("country_id",$id)
        ->where('is_active', 1)
        ->pluck("state_name","id");
        return response()->json($states);
    }
    public function getDistrictList($id)
    {
        $districts = DB::table("districts")
        ->where("state_id",$id)
        ->where('is_active', 1)
        ->pluck("district_name","id");
        return response()->json($districts);
    }
    public function getCityList($id)
    {
        $cities = DB::table("cities")
        ->where("district_id",$id)
        ->where('is_active', 1)
        ->pluck("city_name","id");
        return response()->json($cities);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
