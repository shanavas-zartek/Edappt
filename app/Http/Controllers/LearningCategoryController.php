<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Learningcategory;
use App\Agegroup;
use App\User;
use DB;
use Auth;
use Redirect;
use App\Http\Requests\Learning\StoreLearningCategoryRequest;

class LearningCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        $data = Learningcategory::join('agegroup','ld_category.age_group_id','agegroup.id')
        ->select('agegroup.age_group','ld_category.*')
        ->where('ld_category.is_deleted', 0)->orderBy('id','desc')->get();
        return view('learning.category_list',compact('data'));
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
        if($user->isAbleTo('learning_deveopment')){
        $agegroup = Agegroup::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('learning.category_create',compact('agegroup'));
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
    public function store(StoreLearningCategoryRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        if(($request->ld_category_id !="") && ($request->ld_category_id > 0)){   //update
            $ld_category_id = $request->ld_category_id;
                $affectedRows = Learningcategory::where('id', '=', $ld_category_id)->update([
                    'category'  => ucfirst($request->category),
                    'description'   => $request->description,
                    'age_group_id'        => $request->age_group_id,
                    'is_active'     => $request->status,
                    'is_deleted'    => 0,
                    'updated_by'    => Auth::user()->id,
                    'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'L&D category updated successfully');
       
           return Redirect::to('learning');

        }else{
            $moniter_action =   Learningcategory::create([
                'category'  => ucfirst($request->category),
                'description'   => $request->description,
                'age_group_id'   => $request->age_group_id,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by' =>0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'L&D category created successfully');
       
           return Redirect::to('learning');
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
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        $agegroup = Agegroup::where('is_deleted', 0)->orderBy('id','desc')->get();
        $edit =  Learningcategory::where('id',$id)->first();
        return view('learning.category_create',compact('edit','agegroup'));
        ;
    }else{
        abort(403,"You don't have permission to access this page");
    }
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
     /***Delete Learning Category***/
     public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        Learningcategory::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
        return Redirect::to('learning')
        ->with('alert-success','L&D category deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
