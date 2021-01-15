<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Company;
use DB;
use Auth;
use Redirect;
use App\User;
class CompanyController extends Controller
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
        $data = Company::where('is_deleted', 0)->where('is_active', 1)->first();
        $countries = DB::table("countries")->where('is_active', 1)->pluck("country_name","id");
        $states = DB::table("states")->where('is_active', 1)->where("country_id",$data->country)->pluck("state_name","id");
        $districts = DB::table("districts")->where("state_id",$data->state)->where('is_active', 1)->pluck("district_name","id");
        $cities = DB::table("cities")->where("district_id",$data->district)->where('is_active', 1)->pluck("city_name","id");
        return view('company.settings',compact('data','countries','states','cities','districts'));
        }  else{
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
    	if(($request->comp_id !="") && ($request->comp_id > 0)){   //update
            $comp_id = $request->comp_id;
            $affectedRows = Company::where('id', '=', $comp_id)->update([
                'name'          => ucfirst($request->name),
                'email'         => $request->email,
                'phone'   => $request->phone,
                'address1'     => $request->address1,
                'address2'     => $request->address2,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'district'         => $request->district,
                'pincode'   => $request->postcode,
                'contact_person'   => $request->contact_person,
                'is_active'     => 1,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
            ]);
            if($affectedRows){

                $settings = $this->show($comp_id);
                return response()->json(['status'=>200,'message'=>'Company details updated successfully','datas'=>$settings]);
            }
        }else{ //insert
            $action =   Company::create([
                'name'          => ucfirst($request->name),
                'email'         => $request->email,
                'phone'   => $request->phone,
                'address1'     => $request->address1,
                'address2'     => $request->address2,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'district'         => $request->district,
                'pincode'   => $request->postcode,
                'contact_person'   => $request->contact_person,
                'is_active'     => 1,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0
           ]);
           if($action){
            $compid =  $action->id;
             $settings = $this->show($compid);
             return response()->json(['status'=>200,'message'=>'Company details Inserted successfully','datas'=>$settings]);
         }
        }
    }else{
        abort(403,"You don't have permission to access this page");

    }
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Company::
        join( 'countries', 'company_settings.country', '=', 'countries.id')
        ->join('states', 'company_settings.state', '=', 'states.id')
        ->join('cities', 'company_settings.city', '=', 'cities.id')
        ->join('districts', 'company_settings.district', '=', 'districts.id')
        ->select('company_settings.*','countries.country_name','states.state_name','districts.district_name','cities.city_name')
        ->where('company_settings.id',$id)->where('company_settings.is_deleted', 0)->where('company_settings.is_active', 1)
        ->first();
      
        return $data;
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
