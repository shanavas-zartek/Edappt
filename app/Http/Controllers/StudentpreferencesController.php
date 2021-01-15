<?php

namespace App\Http\Controllers;

use App\Studentpreferences;
use Illuminate\Http\Request;
use App\Http\Requests\Studentpreferences\StoreStudentpreferencesRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class StudentpreferencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $user = User::find(Auth::id());
        if($user->isAbleTo('preferences')){
       $data = DB::select("SELECT * from student_details where student_details.id IN (SELECT student_id from student_preferences)");   
       return view('studentpreferences.studentpreferenceindex',compact('data'));
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
     * @param  \App\Studentpreferences  $studentpreferences
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('preferences')){
        $show = Studentpreferences::join( 'student_details', 'student_preferences.student_id', '=', 'student_details.id')
       
        ->join('preference_category', 'student_preferences.preference_category_id', '=', 'preference_category.id')
        
        ->select('student_details.*','preference_category.*','student_preferences.*')
       
        
        ->where('student_preferences.student_id',$id)->where('student_preferences.is_deleted', 0)
        ->first();
       
        return view('studentpreferences.studentpreferenceview',compact('show'));
    }else{
        abort(403,"You don't have permission to access this page");
    }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentpreferences  $studentpreferences
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentpreferences $studentpreferences)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentpreferences  $studentpreferences
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentpreferences $studentpreferences)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentpreferences  $studentpreferences
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentpreferences $studentpreferences)
    {
        //
    }
}
