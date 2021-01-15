<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use DB;
use Auth;
use Redirect;
use App\Http\Requests\Subscription\StoreSubscriptionRequest;
class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Subscription::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('subscription.subscription_list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subscription.subscription_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionRequest $request)
    {
        if(($request->plan_id !="") && ($request->plan_id > 0)){   //update
            $plan_id = $request->plan_id;
                $affectedRows = Subscription::where('id', '=', $plan_id)->update([
                'package_name'  => ucfirst($request->package_name),
                'description'   => $request->description,
                'amount'        => $request->amount,
                'duration'      =>$request->duration,
                'start_date'    =>$request->start_date,
                'end_date'      => $request->end_date,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'updated_by'    => Auth::user()->id,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Subscription plan updated successfully');
       
           return Redirect::to('subscription');

        }else{
            $moniter_action =   Subscription::create([
                'package_name'  => ucfirst($request->package_name),
                'description'   => $request->description,
                'amount'        => $request->amount,
                'duration'      =>$request->duration,
                'start_date'    =>$request->start_date,
                'end_date'      => $request->end_date,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Subscription plan created successfully');
       
           return Redirect::to('subscription');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit =  Subscription::where('id',$id)->first();
        return view('subscription.subscription_create',compact('edit'));
        ;
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
       /***Delete subscription plans***/
       public function delete($id){
        Subscription::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
        
        return Redirect::to('subscription')
        ->with('alert-success','Subscription Plan deleted successfully.');
    
    } 
    public function subscriptions(){
        $show= Subscription::where('is_deleted',0)->where('is_active',1)
        ->select('id','package_name','description','amount','duration','start_date','end_date','is_active')
        ->orderBy('id','desc')->get();
      return  json_encode($show);
       
    }
}
