<?php

namespace App\Http\Controllers;
use App\Studygroupdtl;
use App\Studygroup;
use Illuminate\Http\Request;
use App\Http\Requests\Studygroup\StoreStudygroupRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class StudygroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('study_groups')){
        $data = Studygroup::join('student_details','study_group_hdr.requested_student_id','student_details.id')
        ->select('study_group_hdr.id','study_group_hdr.group_name',
        'study_group_hdr.is_active',
        'study_group_hdr.start_date',
        'study_group_hdr.end_date',
        'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name'
        )
        ->where('study_group_hdr.is_deleted', 0)->orderBy('id','desc')->get();
       
       return view('studygroup.studygrouplist',compact('data'));
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
    public function store(StoreStudygroupRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('study_groups')){

        if(isset($request->hdr_id) && $request->hdr_id !="") {
            $hdr_id =$request->hdr_id;
          $affectedRows = Studygroup::where('id', '=', $hdr_id)->update([
              'group_name'  => $request->group_name,
              'is_active'     => $request->status,
              'is_deleted'     => 0,
              'updated_by'     => Auth::user()->id,
              'deleted_by' =>0
         ]);
        
         Studygroupdtl::where('study_group_hdr_id','=', $hdr_id)->delete();

         // study_group_dtl table --insertion

      
          foreach ($request->studentlist as $student_id) {
           $moniter_action1 = Studygroupdtl::create([
            'study_group_hdr_id'=> $hdr_id,
            'student_id' => $student_id,
            'is_active'     => $request->status,
            'is_deleted'     => 0,
            'created_by'     => Auth::user()->id,
            'updated_by' => 0,
            'deleted_by' => 0
       ]);
       
    }
         
         $request->session()->flash('alert-success', 'Study Group updated successfully');
         return Redirect::to('studygroup');
        }else{
          $request->session()->flash('alert-danger', 'Failed to update Study Group');
          return Redirect::to('studygroup');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Studygroup  $studygroup
     * @return \Illuminate\Http\Response
     */
    public function show(Studygroup $studygroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studygroup  $studygroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = User::find(Auth::id());
        if($user->isAbleTo('study_groups')){

        $data = Studygroup::join('study_group_dtl','study_group_hdr.id', '=','study_group_dtl.study_group_hdr_id')
        ->select('study_group_hdr.group_name', 'study_group_hdr.is_active',  'study_group_hdr.id','study_group_dtl.student_id')
        ->where('study_group_hdr.is_deleted', 0)->where('study_group_hdr.id',$id)->first();

       $selected_students = DB::select("Select student_details.id,student_details.student_code,student_details.first_name,student_details.middle_name,student_details.last_name,  1 as status from study_group_dtl inner join student_details on student_details.id = study_group_dtl.student_id where study_group_dtl.is_deleted = 0 AND study_group_hdr_id = $id");
       $unselected_students =  DB::select("SELECT *,0 as status from student_details WHERE id not in (SELECT student_id from study_group_dtl where study_group_hdr_id = $id)"); 
        // studnt list with selected and unselected status
        $studentlist = array_merge($selected_students,$unselected_students);
       return view('studygroup.studygroupedit',compact('data','studentlist'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studygroup  $studygroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studygroup $studygroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studygroup  $studygroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studygroup $studygroup)
    {
        //
    }


    public function delete($id){
 $user = User::find(Auth::id());
        if($user->isAbleTo('study_groups')){
       
        DB::table('study_group_hdr')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        DB::table('study_group_dtl')
        ->where('study_group_hdr_id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('studygroup')
        ->with('alert-success','Study Group deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
