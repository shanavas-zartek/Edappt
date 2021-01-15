<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OptionpollQuestions;
use App\OptionpollAnswers;
use App\Optionpolltype;
use DB;
use Auth;
use Redirect;
use App\User;
class StudentOpinionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
       $data = OptionpollQuestions::where('option_poll_questions.is_deleted', 0)
       ->join('option_poll_types','option_poll_types.id','option_poll_questions.poll_type_id')
       ->join('student_opinions','student_opinions.opinion_poll_question_id','option_poll_questions.id')
       ->join('option_poll_answers','student_opinions.opinion_poll_answer_id','option_poll_answers.id')
       ->join('student_details','student_opinions.student_id','student_details.id')

       ->select('option_poll_questions.id','option_poll_questions.question','option_poll_types.type','student_details.first_name','student_details.middle_name','student_details.last_name','student_opinions.student_id','option_poll_answers.answer')
       ->orderBy('option_poll_questions.id','desc')
       ->get();
      
        return view('optionpoll.student_opinions',compact('data'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
