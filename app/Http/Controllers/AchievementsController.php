<?php

namespace App\Http\Controllers;

use App\Achievements;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;

class AchievementsController extends Controller
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

        $data = Achievements::join('preference_category','student_achievements.preference_category_id','preference_category.id')
        ->join('student_details','student_achievements.student_id','student_details.id')
        ->select('student_achievements.id',        'student_achievements.title',
        'student_achievements.image',
        'student_achievements.approval_status',
        'student_achievements.approved_on',
        'student_achievements.is_active',
        'student_achievements.preference_category_id',
        'preference_category.category_name',
        'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name')
        ->where('student_achievements.is_deleted', 0)->orderBy('id','desc')->get();
       
       return view('studentAchievements.achievementslist',compact('data'));
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
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

      if(isset($request->archievemnt_id) && $request->archievemnt_id !="") {
          $id =$request->archievemnt_id;
        $affectedRows = Achievements::where('id', '=', $id)->update([
            'approval_status'  => $request->approval_status,
            'approved_on'   => date('Y-m-d'),
            'is_active'     => $request->status,
            'is_deleted'     => 0,
            'updated_by'     => Auth::user()->id,
            'deleted_by' =>0
       ]);
       $request->session()->flash('alert-success', 'Achievement updated successfully');
       return Redirect::to('achievements');
      }else{
        $request->session()->flash('alert-danger', 'Failed to update Achievement');
        return Redirect::to('achievements');
      }
     
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
   
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentdetails  $studentdetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $data = Achievements::join('preference_category','student_achievements.preference_category_id','preference_category.id')
        ->join('student_details','student_achievements.student_id','student_details.id')
        ->select('student_achievements.id','student_achievements.title',
        'student_achievements.image',
        'student_achievements.approval_status',
        'student_achievements.approved_on',
        'student_achievements.is_active',
        'student_achievements.preference_category_id',
        'preference_category.category_name',
        'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name')
        ->where('student_achievements.is_deleted', 0)->where('student_achievements.id',$id)->first();
        
        return view('studentAchievements.achievementsview',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentdetails  $studentdetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentdetails $studentdetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentdetails  $studentdetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentdetails $studentdetails)
    {
        //
    }
   
}
