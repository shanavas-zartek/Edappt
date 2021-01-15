<?php

namespace App\Http\Controllers;

use App\Discussionforumcategory;
use Illuminate\Http\Request;
use App\Http\Requests\Discussionforumcategory\StoreDiscussionforumcategoryRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class DiscussionforumcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){
        $data =Discussionforumcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('discussionforumcategory.discussionforumcategory_index',compact('data'));
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
        if($user->isAbleTo('discussion_forum')){
        return view('discussionforumcategory.discussionforumcategory_create');
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
    public function store(StoreDiscussionforumcategoryRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){

        if(($request->discussion_forum_cat_id !="") && ($request->discussion_forum_cat_id > 0)){   //update
            $discussion_forum_cat_id = $request->discussion_forum_cat_id;
                $affectedRows = Discussionforumcategory::where('id', '=', $discussion_forum_cat_id)->update([
                'category_name'          => ucfirst($request->category_name),
                'description'   => $request->description,
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Discussion Forum Category updated successfully');
       
           return Redirect::to('discussionforumcategory');

        }else{

            $moniter_action =   Discussionforumcategory::create([
           
                'category_name'          => ucfirst($request->category_name),
                'description'   => $request->description,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Discussion Forum Category created successfully');
       
           return Redirect::to('discussionforumcategory');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discussionforumcategory  $discussionforumcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Discussionforumcategory $discussionforumcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discussionforumcategory  $discussionforumcategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){

        $edit =  Discussionforumcategory::where('id',$id)->first();
        return view('discussionforumcategory.discussionforumcategory_create',compact('edit'));
        ;
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussionforumcategory  $discussionforumcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussionforumcategory $discussionforumcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussionforumcategory  $discussionforumcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussionforumcategory $discussionforumcategory)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){

        Discussionforumcategory::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
            return Redirect::to('discussionforumcategory')
            ->with('alert-success','Discussion Forum Category deleted successfully.');
        }else{
        abort(403,"You don't have permission to access this page");
    }
        }
}
