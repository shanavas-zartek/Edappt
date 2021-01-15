<?php

namespace App\Http\Controllers;

use App\Studentgoals;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;
class StudentgoalsController extends Controller
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

        $data = Studentgoals::join( 'student_details', 'student_goals.student_id', '=', 'student_details.id')
         ->select( 'student_details.first_name',
         'student_details.middle_name',
         'student_details.last_name','student_goals.*')
         ->where('student_goals.is_deleted', 0)  ->orderBy('id','desc')
        ->get();
        
       return view('studentgoals.studentgoalsindex',compact('data'));
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
     * @param  \App\Studentgoals  $studentgoals
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $show = Studentgoals::join( 'student_details', 'student_goals.student_id', '=', 'student_details.id')
             ->select('student_details.*','student_goals.*')
               ->where('student_goals.id',$id)->where('student_goals.is_deleted', 0)
        ->first();
        
       return view('studentgoals.studentgoalsview',compact('show'));
    }else{
        abort(403,"You don't have permission to access this page");
    } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentgoals  $studentgoals
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentgoals $studentgoals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentgoals  $studentgoals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentgoals $studentgoals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentgoals  $studentgoals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentgoals $studentgoals)
    {
        //
    }
}
