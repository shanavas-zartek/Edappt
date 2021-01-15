<?php

namespace App\Http\Controllers;
use App\Discussionforumcategory;
use App\Discussionforum;
use Illuminate\Http\Request;
use App\Http\Requests\Discussionforum\StoreDiscussionforumRequest;

use DB;
use Auth;
use Redirect;
use App\User;
class DiscussionforumController extends Controller
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
        $data = Discussionforum::join( 'discussion_forum_category', 'discussion_forum_hdr.discussion_category_id', '=', 'discussion_forum_category.id')
        ->select('discussion_forum_hdr.*','discussion_forum_category.category_name')
        ->where('discussion_forum_hdr.is_deleted',0)
        ->orderBy('id','desc')
        ->get();
        return view('discussionforum.discussionforum_index',compact('data'));
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
        $discussioncategory = Discussionforumcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
       
        return view('discussionforum.discussionforum_create',compact('discussioncategory'));
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
     public function store(StoreDiscussionforumRequest $request)
     {
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){
        if(($request->hdr_id !="") && ($request->hdr_id > 0)){   //update
            $time = date('y-m-d-h-i-s');

            if($request->hasFile('image')) {
                $file = $request->file('image') ;
                 $image = 'discussion_'.$time.'.'.            $file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/DiscussionForum' ;
                $file->move($destinationPath,$image);
            }
            else{
                $image= $request->old_image ;
            }

            $discussion_id = $request->hdr_id;
                $affectedRows =Discussionforum::where('id', '=', $discussion_id )->update([
                    'topic'  => ucfirst($request->topic),
                    'description'   => $request->description,
                    'discussion_category_id'    =>$request->discussion_category_id,
                    'start_date'      => $request->start_date,
                    'end_date'      => $request->end_date,
                    'image'        => $image,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'updated_by'    => Auth::user()->id,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Discussion Forum  updated successfully');
       
           return Redirect::to('discussionforum');

         }else{
 
            $time = date('y-m-d-h-i-s');

            if($request->hasFile('image')) {
                $file = $request->file('image') ;
                 $image = 'discussion_'.$time.'.'.            $file->getClientOriginalExtension();

                $destinationPath = public_path().'/uploads/DiscussionForum' ;
                $file->move($destinationPath,$image);
            }
            else{
                $image='';
            }

            $moniter_action =  DiscussionForum::create([
                'topic'  => ucfirst($request->topic),
                'description'   => $request->description,
                'discussion_category_id'    =>$request->discussion_category_id,
                'start_date'      => $request->start_date,
                'end_date'      => $request->end_date,
                'image'        => $image,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by' =>0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Discussion Forum created successfully');
       
           return Redirect::to('discussionforum');
        }

    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discussionforum  $discussionforum
     * @return \Illuminate\Http\Response
     */
    public function show(Discussionforum $discussionforum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discussionforum  $discussionforum
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
    $user = User::find(Auth::id());
    if($user->isAbleTo('discussion_forum')){
        $edit =  Discussionforum::where('id',$id)->first();
        $discussioncategory= Discussionforumcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
       
        return view('discussionforum.discussionforum_create',compact('discussioncategory','edit'));

    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussionforum  $discussionforum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussionforum $discussionforum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussionforum  $discussionforum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussionforum $discussionforum)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){

        DB::table('discussion_forum_hdr')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        DB::table('discussion_forum_dtl')
        ->where('discussion_hdr_id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        
        return Redirect::to('discussionforum')
        ->with('alert-success','Discussion Forum deleted successfully.');
    
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
