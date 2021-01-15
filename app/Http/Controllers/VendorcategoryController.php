<?php

namespace App\Http\Controllers;

use App\Vendorcategory;
use Illuminate\Http\Request;
use App\Http\Requests\Vendorcategory\StoreVendorcategoryRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class VendorcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        $data = Vendorcategory::where('is_deleted', 0) ->orderBy('id','desc')->get();
        return view('vendorcategory.index',compact('data'));
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
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){
        return view('vendorcategory.create');
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
    public function store(StoreVendorcategoryRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        if(($request->vendor_cat_id !="") && ($request->vendor_cat_id > 0)){   //update
            $vendor_cat_id= $request->vendor_cat_id;
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('icon_image')) {
                $file = $request->file('icon_image') ;
                
                $icon = $time.'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/help' ;
                $file->move($destinationPath,$icon);
            }
            else{
               
                $icon=$request->image1;
            }
                $affectedRows = Vendorcategory::where('id', '=', $vendor_cat_id)->update([
                'category' => ucfirst($request->category),
                'description'   => $request->description,
                'icon'=>$icon,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,
           ]);
               
          
           
         
           $request->session()->flash('alert-success', 'Vendor category updated successfully');
       
           return Redirect::to('vendorcategory');

        }else{
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('icon_image')) {
                $file = $request->file('icon_image') ;
                
                $icon = $time.'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/help' ;
                $file->move($destinationPath,$icon);
            }
            else{
               
                $icon='';
            }
            $moniter_action =   Vendorcategory::create([
           
                'category'          => ucfirst($request->category),
                'description'   => $request->description,
                'icon'=>$icon,
               'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
           ]);
          
           $request->session()->flash('alert-success', 'Vendor category created successfully');
       
           return Redirect::to('vendorcategory');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendorcategory  $vendorcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Vendorcategory $vendorcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendorcategory  $vendorcategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        $edit = Vendorcategory::where('id',$id)->first();
        return view('vendorcategory.create',compact('edit'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendorcategory  $vendorcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendorcategory $vendorcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendorcategory  $vendorcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendorcategory $vendorcategory)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('vendors')){

        DB::table('vendor_category')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('vendorcategory')
        ->with('alert-success','vendor category deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
