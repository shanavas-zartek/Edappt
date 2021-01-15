<?php

namespace App\Http\Controllers;

use App\Postings;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;
class PostingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $data = Postings::join( 'student_details', 'student_postings.student_id', '=', 'student_details.id')
       
        ->select( 'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name','student_postings.*')
       
        ->where('student_postings.is_deleted', 0) 
        ->orderBy('student_postings.id','desc')
        ->get();
        
       return view('postings.postingsindex',compact('data'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Postings  $postings
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $data = Postings::join( 'student_details', 'student_postings.student_id', '=', 'student_details.id')
       
        ->select('student_details.*','student_postings.*')
       
        ->where('student_postings.is_deleted', 0)  ->where('student_postings.id',$id)
       
        ->first();
        
       return view('postings.postingsview',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Postings  $postings
     * @return \Illuminate\Http\Response
     */
    public function edit(Postings $postings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Postings  $postings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postings $postings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Postings  $postings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postings $postings)
    {
        //
    }
    public function delete($id){
       $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        DB::table('student_postings')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('postings')
        ->with('alert-success','Posts deleted successfully.');
      }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
