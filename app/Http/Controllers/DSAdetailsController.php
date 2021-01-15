<?php

namespace App\Http\Controllers;
use App\Http\Requests\DSAdetails\StoreDSAdetailsRequest;
use App\DSAdetails;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;
use App\Vendors;
use Illuminate\Support\Facades\Hash;

class DSAdetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     { 
         //$user = User::find(Auth::id());
         //if($user->isAbleTo('vendors')){
 
         $data = DSAdetails::where('dsa_details.is_deleted',0) ->orderBy('id','desc')
         ->get();
       //  ->join('vendor_category', 'vendor_details.vendor_category_id', '=', 'vendor_category.id')
       // ->select('vendor_details.*','vendor_category.category','agegroup.age_group')
        //->where('dsa_details.is_deleted',0) ->orderBy('id','desc')
        //->get();
        
         return view('DSAdetails.dsa_index',compact('data'));
    // }else{
         //abort(403,"You don't have permission to access this page");
    // }
     }

     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$user = User::find(Auth::id());
       // if($user->isAbleTo('settings')){
       // $vendor= DB::table('vendor_category')->where('is_deleted', 0)->pluck("category","id");
        $countries = DB::table("countries")->where('is_active', 1)->pluck("country_name","id");
            return view('DSAdetails.dsa_create',compact('countries'));
      //  }else{
           // abort(403,"You don't have permission to access this page");
       // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDSAdetailsRequest $request)
    {
      //  $user = User::find(Auth::id());
        //if($user->isAbleTo('vendors')){

        if(($request->DSA_id !="") && ($request->DSA_id > 0)){   //update
            $DSA_id = $request->DSA_id;
            $affectedRows = DSAdetails::where('id', '=', $DSA_id)->update([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'email'         => $request->email,
                'contact_no'   => $request->contact_no,
                'address'     => $request->address,
                'alternate_no'   => $request->alternate_no,
                'district'  => $request->district,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
               
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                
                'deleted_by'     => 0,
           ]);
           if(!empty($request->password)){    
            $password = Hash::make($request->password);
           }else{
            $password = $request->old_password;
           }

          $userdata =  User::where('dsa_id', '=', $DSA_id)->update([
            'name'          => $request->first_name." ".$request->last_name,
            'email'         => $request->email,
            'password' =>  $password]);

            $request->session()->flash('alert-success', 'DSA Updated successfully');
       
           return Redirect::to('DSAdetails');
        }else{ //insert
            $moniter_action=   DSAdetails::create([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'email'         => $request->email,
                'contact_no'   => $request->contact_no,
                'address'     => $request->address,
                'alternate_no'   => $request->alternate_no,
                'district'  => $request->district,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
               
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by'     => 0,
           ]);
           if($moniter_action){

            $password =  Hash::make($request->password);
              $userdata =  User::create([
                'name'          => $request->first_name." ".$request->last_name,
                'email'         => $request->email,
                'is_admin'      => 0,
                'dsa_id' =>  $moniter_action->id,
                'password' =>  $password]);
           }
           $request->session()->flash('alert-success', 'DSA  created successfully');
       
           return Redirect::to('DSAdetails');
        }
   // }else{
       // abort(403,"You don't have permission to access this page");
   // }
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DSAdetails  $dSAdetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show= DSAdetails::join( 'countries', 'dsa_details.country', '=', 'countries.id')
        ->leftJoin('states', 'dsa_details.state', '=', 'states.id')
        ->leftJoin('cities', 'dsa_details.city', '=', 'cities.id')
        ->leftJoin('districts', 'dsa_details.district', '=', 'districts.id')
       
        ->select('dsa_details.*','countries.country_name','states.state_name','districts.district_name','cities.city_name')
       
         ->where('dsa_details.id',$id)->where('dsa_details.is_deleted', 0)
       ->first();
       $vendor_detail=    
       Vendors::join( 'agegroup', 'vendor_details.age_group_id', '=', 'agegroup.id')
       ->join('vendor_category', 'vendor_details.vendor_category_id', '=', 'vendor_category.id')
      ->select('vendor_details.*','vendor_category.category','agegroup.age_group')
      ->where('vendor_details.is_deleted',0)->where('vendor_details.DSA_id',$id) ->orderBy('id','desc')
      ->get();
      
       return view('DSAdetails.dsa_view',compact('show','vendor_detail'));
     }
     public function alllist(){
         $show= Parentdetail::where('is_deleted',0)->orderBy('id','desc')->get();
       return  json_encode($show);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DSAdetails  $dSAdetails
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         // $user = User::find(Auth::id());
         //if($user->isAbleTo('vendors')){
 
         $edit = DSAdetails::where('id',$id)->first();
         
         //$vendor = DB::table('vendor_category')->where('is_deleted', 0)->pluck("category","id");
         $countries = DB::table("countries")->where('is_active', 1)->pluck("country_name","id");
         $states = DB::table("states")->where('is_active', 1)->where("country_id",$edit->country)->pluck("state_name","id");
         $districts = DB::table("districts")->where("state_id",$edit->state)->where('is_active', 1)->pluck("district_name","id");
        $cities = DB::table("cities")->where("district_id",$edit->district)->where('is_active', 1)->pluck("city_name","id");
         return view('DSAdetails.dsa_create',compact('edit','countries','states','districts','cities'));
    // }else{
        //abort(403,"You don't have permission to access this page");
   //  }
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DSAdetails  $dSAdetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DSAdetails $dSAdetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DSAdetails  $dSAdetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(DSAdetails $dSAdetails)
    {
        //
    }
    public function delete($id){
      //  $user = User::find(Auth::id());
        //if($user->isAbleTo('vendors')){

        DB::table('dsa_details')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('DSAdetails')
        ->with('alert-success','DSA  deleted successfully.');
   // }else{
       // abort(403,"You don't have permission to access this page");
  //  }
    
    }
}
