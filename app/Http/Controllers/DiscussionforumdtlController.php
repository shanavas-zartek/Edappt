<?php

namespace App\Http\Controllers;

use App\Discussionforumdtl;
use Illuminate\Http\Request;
use App\Http\Requests\Discussionforumdtl\StoreDiscussionforumdtlRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class DiscussionforumdtlController extends Controller
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

        $data = Discussionforumdtl::join( 'discussion_forum_hdr', 'discussion_forum_dtl.discussion_hdr_id', '=', 'discussion_forum_hdr.id')
        ->join( 'student_details', 'discussion_forum_dtl.student_id', '=', 'student_details.id')
        ->select('discussion_forum_hdr.topic', 'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name','discussion_forum_dtl.*')
        ->where('discussion_forum_dtl.is_deleted',0)
        ->orderBy('id','desc')
        ->get();
        return view('discussionforumdtl.discussionforumdtl_index',compact('data'));
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
    public function store(StoreDiscussionforumdtlRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){

        if(isset($request->dtl_id) && $request->dtl_id !="") {
            $id =$request->dtl_id;
          $affectedRows = Discussionforumdtl::where('id', '=', $id)->update([
              'approved_status'  => $request->approved_status,
              'approved_on'   => date('Y-m-d'),
              'approved_by'     => Auth::user()->id,
              'is_active'     => $request->status,
              'is_deleted'     => 0,
              'updated_by'     => Auth::user()->id,
              'deleted_by' =>0
         ]);
         $request->session()->flash('alert-success', 'Discussion Forum  updated successfully');
         return Redirect::to('discussionforumdtl');
        }else{
          $request->session()->flash('alert-danger', 'Failed to update Discussion Forum ');
          return Redirect::to('discussionforumdtl');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discussionforumdtl  $discussionforumdtl
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){

        $data = DB::select("SELECT * from v_discussion_forum ");
        return view('discussionforumdtl.discussionforumdtl_viewlist',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discussionforumdtl  $discussionforumdtl
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){

        $edit = Discussionforumdtl::join( 'discussion_forum_hdr', 'discussion_forum_dtl.discussion_hdr_id', '=', 'discussion_forum_hdr.id')
        ->join( 'student_details', 'discussion_forum_dtl.student_id', '=', 'student_details.id')
        ->select('discussion_forum_hdr.*','student_details.*','discussion_forum_dtl.*')
        ->where('discussion_forum_dtl.is_deleted',0) ->where('discussion_forum_dtl.id',$id)
        ->first();
        return view('discussionforumdtl.discussionforumdtl_create',compact('edit'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussionforumdtl  $discussionforumdtl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussionforumdtl $discussionforumdtl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussionforumdtl  $discussionforumdtl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussionforumdtl $discussionforumdtl)
    {
        //
    }public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('discussion_forum')){

        DB::table('discussion_forum_dtl')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('discussionforumdtl')
        ->with('alert-success','Discussion Forum Reply deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

}
