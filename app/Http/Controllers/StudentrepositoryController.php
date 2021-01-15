<?php

namespace App\Http\Controllers;

use App\Studentrepository;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;
class StudentrepositoryController extends Controller
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

        $data = Studentrepository::join( 'student_details', 'student_repository_hdr.student_id', '=', 'student_details.id')
       
        
        ->select( 'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name','student_repository_hdr.*')
       
        ->where('student_repository_hdr.is_deleted', 0) 
        ->orderBy('id','desc')
        ->get();
      
        
       return view('studentrepository.studentrepositoryindex',compact('data'));
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
     * @param  \App\Studentrepository  $studentrepository
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $data = Studentrepository::join('student_repository_dtl','student_repository_hdr.id', '=','student_repository_dtl.repository_hdr_id')
        ->join('student_details','student_repository_hdr.student_id', '=','student_details.id')
        ->select('student_repository_dtl.*', 'student_repository_hdr.*','student_details.*')
        ->where('student_repository_hdr.is_deleted', 0)->where('student_repository_hdr.id',$id)->first();

        $show= DB::table('student_repository_dtl')
        ->where('repository_hdr_id', $id)->get();
        return view('studentrepository.studentrepositoryview',compact('data','show'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentrepository  $studentrepository
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentrepository $studentrepository)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentrepository  $studentrepository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentrepository $studentrepository)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentrepository  $studentrepository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentrepository $studentrepository)
    {
        //
    }
    public function delete($id){
 $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){
       
        DB::table('student_repository_hdr')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        DB::table('student_repository_dtl')
        ->where('repository_hdr_id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('studentrepository')
        ->with('alert-success','Student Repository deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
