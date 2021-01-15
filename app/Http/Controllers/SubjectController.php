<?php

namespace App\Http\Controllers;

use App\Subjects;
use Illuminate\Http\Request;
use App\Http\Requests\Subjects\StoreSubjectsRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class SubjectController extends Controller
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

        $data = Subjects::where('is_deleted', 0) ->orderBy('id','desc')->get();
        return view('subjects.subject_list',compact('data'));
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

        return view('subjects.subject_create');
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
    public function store(StoreSubjectsRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){

        if(($request->subject_id !="") && ($request->subject_id > 0)){   //update
            $subject_id= $request->subject_id;
          
                $affectedRows = Subjects::where('id', '=', $subject_id)->update([
                'subject' => ucfirst($request->subject),
                'description'   => $request->description,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,
           ]);
               
           $request->session()->flash('alert-success', 'Subject updated successfully');
       
           return Redirect::to('subject');

        }else{

            $moniter_action =   Subjects::create([        
                'subject'       => ucfirst($request->subject),
                'description'   => $request->description,
                'is_active'     =>$request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by'    => 0,
                'deleted_by'    => 0,
           ]);
          
           $request->session()->flash('alert-success', 'Subject created successfully');
       
           return Redirect::to('subject');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subjects  $Subjects
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects $Subjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subjects  $Subjects
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){

        $edit = Subjects::where('id',$id)->first();
        return view('subjects.subject_create',compact('edit'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subjects  $Subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects $Subjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subjects  $Subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $Subjects)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){

        DB::table('activity_subject')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('subject')
        ->with('alert-success','Subject deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
