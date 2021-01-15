<?php

namespace App\Http\Controllers;

use App\Contentcategory;
use Illuminate\Http\Request;
use App\Http\Requests\Contentcategory\StoreContentcategoryRequest;
use DB;
use Auth;
use Redirect;
use App\User;

class ContentcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){
        $data = Contentcategory::join( 'agegroup', 'content_category.age_group_id', '=', 'agegroup.id')
        ->select('content_category.*','agegroup.age_group')
        ->where('content_category.is_deleted',0)->orderBy('id','desc')
        ->get();
        return view('contentcategory.index',compact('data'));
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
        if($user->isAbleTo('activities')){
            $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
            return view('contentcategory.create',compact('age'));
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
     
     public function store(StoreContentcategoryRequest $request)
     {
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){

        if(($request->content_cat_id !="") && ($request->content_cat_id > 0)){   //update
            $content_cat_id= $request->content_cat_id;
          
                $affectedRows = Contentcategory::where('id', '=', $content_cat_id)->update([
                'category' => ucfirst($request->category),
                'description'   => $request->description,
                'age_group_id'  => $request->age,
                'day'            => $request->day,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,
           ]);
               
         
         
           $request->session()->flash('alert-success', 'Content category updated successfully');
       
           return Redirect::to('contentcategory');

        }else{

            $moniter_action =   Contentcategory::create([
           
                'category'          => ucfirst($request->category),
                'description'   => $request->description,
                'age_group_id'  => $request->age,
                'day'            => $request->day,
               
               'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
           ]);
          
           $request->session()->flash('alert-success', 'Content category created successfully');
       
           return Redirect::to('contentcategory');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contentcategory  $contentcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Contentcategory $contentcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contentcategory  $contentcategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){
            $edit = Contentcategory::where('id',$id)->first();
            $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
            return view('contentcategory.create',compact('edit','age'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contentcategory  $contentcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contentcategory $contentcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contentcategory  $contentcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contentcategory $contentcategory)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){
        DB::table('content_category')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('contentcategory')
        ->with('alert-success','content category deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    
    /**
     * FOR API CALL
     */
    public function get_category_list() {
        $data = Contentcategory::orderBy('id','desc')->get();
        return response()->json($data);

    }
}
