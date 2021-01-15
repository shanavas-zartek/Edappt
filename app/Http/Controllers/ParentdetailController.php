<?php

namespace App\Http\Controllers;
use App\Studentdetails;

use App\Parentdetail;
use Illuminate\Http\Request;
use App\Http\Requests\Parentdetail\StoreParentdetailRequest;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Redirect;
use App\User;
use App\Appusers;
use App\Payments;
class ParentdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('parent_details')){

        $data = Parentdetail::leftJoin( 'countries', 'parent_details.country', '=', 'countries.id')
        ->leftJoin('states', 'parent_details.state', '=', 'states.id')
        ->leftJoin('districts', 'parent_details.district', '=', 'districts.id')
        ->leftJoin('cities', 'parent_details.city', '=', 'cities.id')
        ->select('parent_details.*','countries.country_name','states.state_name','districts.district_name','cities.city_name')
        ->where('parent_details.is_deleted', 0)
        ->orderBy('id','desc')
        ->get();
       return view('parentdetail.index',compact('data'));
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
    public function store(StoreParentdetailRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('parent_details')){

        if(($request->parent_id !="") && ($request->parent_id > 0)){   //update
            $parent_id = $request->parent_id;
            $affectedRows = Parentdetail::where('id', '=', $parent_id)->update([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'middle_name'          => ucfirst($request->middle_name),
                'email'         => $request->email,
                'contact_no'   => $request->contact_no,
                'address'     => $request->address,
                'district'  => $request->district,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
                'mobile_verified_on'   => $request->mobile_verified_on,
                'mobile_verified_status'=> $request->mobile_verified_status,
                'alternate_no'   => $request->alternate_no,
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,
           ]);
           
            $request->session()->flash('alert-success', 'Parent Details Updated successfully');
       
           return Redirect::to('parentdetail');
        }else{ //insert
            $moniter_action=   Parentdetail::create([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'middle_name'          => ucfirst($request->middle_name),
                'email'         => $request->email,
                'contact_no'   => $request->contact_no,
                'address'     => $request->address,
                'district'  => $request->district,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
                'mobile_verified_on'   => $request->mobile_verified_on,
                'mobile_verified_status' => $request->mobile_verified_status,
                'alternate_no'   => $request->alternate_no,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by'     => 0,
           ]);
           $request->session()->flash('alert-success', 'Parent Details  created successfully');
       
           return Redirect::to('parentdetail');
           
        }
       
    }else{
        abort(403,"You don't have permission to access this page");
    }

   
   


    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Parentdetail  $parentdetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {               
       $show= Parentdetail::join( 'countries', 'parent_details.country', '=', 'countries.id')
       ->leftJoin('states', 'parent_details.state', '=', 'states.id')
       ->leftJoin('cities', 'parent_details.city', '=', 'cities.id')
       ->leftJoin('districts', 'parent_details.district', '=', 'districts.id')
       ->leftJoin('v_payments', 'parent_details.id', '=', 'v_payments.parent_id')
       ->leftJoin('subscription_plans', 'v_payments.subscription_plan_id', '=', 'subscription_plans.id')
       ->select('parent_details.*','countries.country_name','states.state_name','districts.district_name','cities.city_name','subscription_plans.package_name','v_payments.subscription_end_date','v_payments.paid_amount')
      
        ->where('parent_details.id',$id)->where('parent_details.is_deleted', 0)
      ->first();
      $student_detail= Studentdetails::where(['parent_id'=>$id,'is_deleted'=>0])->get();      

      $payments= Payments::join( 'subscription_plans', 'payments.subscription_plan_id', '=', 'subscription_plans.id')
      ->select('payments.*','subscription_plans.package_name')
      ->where(['payments.parent_id'=>$id,'payments.is_deleted'=>0])->get();
    //   print_r( $payments);die;
      return view('parentdetail.parentview',compact('show','student_detail','payments'));
    }
    public function alllist(){
        $show= Parentdetail::where('is_deleted',0)->orderBy('id','desc')->get();
      return  json_encode($show);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parentdetail  $parentdetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('parent_details')){
            
        $edit = Parentdetail::where('parent_details.id',$id)->
        select('parent_details.*','app_users.password')->leftJoin('app_users','parent_details.id','app_users.parent_id')->first();
       
       $countries = DB::table("countries")->where('is_active', 1)->pluck("country_name","id");
       $states = DB::table("states")->where("country_id",$edit->country)->where('is_active', 1)->pluck("state_name","id");
       $districts = DB::table("districts")->where("state_id",$edit->state)->where('is_active', 1)->pluck("district_name","id");
       $cities = DB::table("cities")->where("district_id",$edit->district)->where('is_active', 1)->pluck("city_name","id");

        return view('parentdetail.create',compact('edit','countries','states','districts','cities'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parentdetail  $parentdetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parentdetail $parentdetail)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parentdetail  $parentdetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parentdetail $parentdetail)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('parent_details')){

        DB::table('parent_details')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('parentdetail')
        ->with('alert-success','Parent details  deleted successfully.');
     }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    public function resetPassword($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('parent_details')){

        $pass=rand();
        $password = Hash::make($pass);
        $appuserdata = Appusers::where('parent_id', '=', $id)->update([
        'password' =>  $password]);
        return Redirect::to('parentdetail')
        ->with('alert-success','Password Reset successfully.');
         }else{
            abort(403,"You don't have permission to access this page");
        }
    }
}



