<?php

namespace App\Http\Controllers;

use App\Studentscrapbook;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;
class StudentscrapbookController extends Controller
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

        $data = Studentscrapbook::join( 'student_details', 'scrap_book.student_id', '=', 'student_details.id')
        ->select( 'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name','scrap_book.*')
        ->where('scrap_book.is_deleted', 0)  ->orderBy('id','desc')
        ->get();
        
       return view('studentscrapbook.studentscrapbookindex',compact('data'));
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
     * @param  \App\Studentscrapbook  $studentscrapbook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $show = Studentscrapbook::join( 'student_details', 'scrap_book.student_id', '=', 'student_details.id')
        ->select('student_details.*','scrap_book.*')
       
        ->where('scrap_book.id',$id)->where('scrap_book.is_deleted', 0)
        ->first();
        
       return view('studentscrapbook.studentscrapbookview',compact('show'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentscrapbook  $studentscrapbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentscrapbook $studentscrapbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentscrapbook  $studentscrapbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentscrapbook $studentscrapbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentscrapbook  $studentscrapbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentscrapbook $studentscrapbook)
    {
        //
    }
}
