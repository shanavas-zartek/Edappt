<?php

namespace App\Http\Controllers;

use App\Vendors;
use Illuminate\Http\Request;
use App\Http\Requests\Vendors\StoreVendorsRequest;
use DB;
use Auth;
use Redirect;
use App\User;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        $data = Vendors::join( 'agegroup', 'vendor_details.age_group_id', '=', 'agegroup.id')
        ->join('vendor_category', 'vendor_details.vendor_category_id', '=', 'vendor_category.id')
       ->select('vendor_details.*','vendor_category.category','agegroup.age_group')
       ->where('vendor_details.is_deleted',0) ->orderBy('id','desc')
       ->get();
       
        return view('vendors.index',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){
        $DSA_id=$id;
        $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
        $vendor= DB::table('vendor_category')->where('is_deleted', 0)->pluck("category","id");
        $countries = DB::table("countries")->where('is_active', 1)->pluck("country_name","id");
        return view('vendors.create',compact('age','vendor','countries','DSA_id'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorsRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        if(($request->vendor_id !="") && ($request->vendor_id > 0)){   //update
            $vendor_id = $request->vendor_id;
            $dsa_id= $request->old_DSA_id;
            $affectedRows = Vendors::where('id', '=', $vendor_id)->update([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'email'         => $request->email,
                'phone'   => $request->phone,
                'address'     => $request->address,
                'gender'     => $request->gender,
                'age_group_id'  => $request->age,
                'DSA_id'  => $request->old_DSA_id,
                'vendor_category_id'  => $request->vendor,
                'district'  => $request->district,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
                'dob'   => $request->dob,
                'qualification'         => $request->qualification,
                'subject'   => $request->subject,
                'experience'   => $request->experience,
                'description'   => $request->description,
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                
                'deleted_by'     => 0,
           ]);
            
            $request->session()->flash('alert-success', 'Vendor Updated successfully');
       
           return Redirect::to('vendors');
        }else{ //insert
            $moniter_action=   Vendors::create([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'email'         => $request->email,
                'phone'   => $request->phone,
                'address'     => $request->address,
                'gender'     => $request->gender,
                'age_group_id'  => $request->age,
                 'DSA_id'  => $request->DSA_id,
                'vendor_category_id'  => $request->vendor,
                'city'         => $request->city,
                'district'  => $request->district,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
                'dob'   => $request->dob,
                'qualification'         => $request->qualification,
                'subject'   => $request->subject,
                'experience'   => $request->experience,
                'description'   => $request->description,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by'     => 0,
           ]);
           $request->session()->flash('alert-success', 'Vendor  created successfully');
       
           return Redirect::to('vendors');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendors  $vendors
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        $data = Vendors::where('id', $id)->where('is_deleted', 0)->where('is_active', 1)->first();
        return $data;
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendors  $vendors
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        $edit = Vendors::where('id',$id)->first();
        $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
        $vendor = DB::table('vendor_category')->where('is_deleted', 0)->pluck("category","id");
        $countries = DB::table("countries")->where('is_active', 1)->pluck("country_name","id");
        $states = DB::table("states")->where('is_active', 1)->where("country_id",$edit->country)->pluck("state_name","id");
        $districts = DB::table("districts")->where("state_id",$edit->state)->where('is_active', 1)->pluck("district_name","id");
       $cities = DB::table("cities")->where("district_id",$edit->district)->where('is_active', 1)->pluck("city_name","id");
        return view('vendors.create',compact('edit','age','vendor','countries','states','districts','cities'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendors  $vendors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendors $vendors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendors  $vendors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendors $vendors)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        DB::table('vendor_details')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('vendors')
        ->with('alert-success','vendor  deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    
    }
}
