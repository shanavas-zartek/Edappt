<?php

namespace App\Http\Controllers;

use App\Studentqueries;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;
class StudentqueriesController extends Controller
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

        $data = Studentqueries::join( 'student_details', 'student_queries.student_id', '=', 'student_details.id')
       
        ->join('vendor_details', 'student_queries.vendor_id', '=', 'vendor_details.id')
        
        ->select( 'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name','student_queries.*','vendor_details.first_name as vendor_name')
       
        ->where('student_queries.is_deleted', 0) 
        ->orderBy('id','desc')
        ->get();
        
       return view('studentqueries.studentqueriesindex',compact('data'));
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
     * @param  \App\Studentqueries  $studentqueries
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $show = Studentqueries::join( 'student_details', 'student_queries.student_id', '=', 'student_details.id')
       
        ->join('vendor_details', 'student_queries.vendor_id', '=', 'vendor_details.id')
        
        ->select('student_details.*','student_queries.*','vendor_details.first_name as vendor_name')
       
        ->where('student_queries.id',$id)->where('student_queries.is_deleted', 0)
        ->first();
        
       return view('studentqueries.studentqueriesview',compact('show'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentqueries  $studentqueries
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentqueries $studentqueries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentqueries  $studentqueries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentqueries $studentqueries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentqueries  $studentqueries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentqueries $studentqueries)
    {
        //
    }
}
