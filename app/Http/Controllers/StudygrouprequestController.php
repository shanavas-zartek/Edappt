<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Studygrouprequest;
use App\Studygroup;
use App\Studygroupdtl;
use Illuminate\Http\Request;
use App\Http\Requests\Studygrouprequest\StoreStudygroupRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class StudygrouprequestController extends Controller
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
        $data = Studygrouprequest::join( 'student_details', 'study_group_request.student_id', '=', 'student_details.id')
        ->select( 'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name','study_group_request.*')     
        ->where('study_group_request.is_deleted', 0) ->where('study_group_request.approval_status', 0)  ->orderBy('id','desc')
        ->get();
        
       return view('studygrouprequest.studygrouprequestindex',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
     $user = User::find(Auth::id());
     if($user->isAbleTo('study_groups')){
        $studygroup = Studygrouprequest::join( 'student_details', 'study_group_request.student_id', '=', 'student_details.id')
        ->select('student_details.*','study_group_request.*')
        ->where('study_group_request.is_deleted', 0)->where('study_group_request.id',$id)->first();

        $student = DB::table('student_details')
        ->select('student_details.*')
        ->get();

        return view('studygrouprequest.studygroupcreate',compact('studygroup','student'));
  
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
    public function store(StoreStudygroupRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('study_groups')){
        if(isset($request->study_group_id) && $request->study_group_id !="") {
            $study_group_id =$request->study_group_id;
            
            // getstudygroup  expiry date
            $study_group_expiry =DB::table('system_settings')-> where('module','study_group')->where('parameter','expiry_days')->select('value')->first();
            $newDate =  date('Y-m-d', strtotime("+".$study_group_expiry->value." days"));
            
            // study_group_hdr table --insertion
            $study_group_id= $request->study_group_id;
            $study_group_request=Studygrouprequest::where('id', '=', $study_group_id)->first();
          
            $moniter_action = Studygroup::create([
           
                'group_name'    => ucfirst($request->group_name),
                'requested_student_id'=> $study_group_request->student_id,
                'chat_option'=> 1,
                'zoom_call_option'=> 1,
                'start_date' =>  date('Y-m-d'),
                'end_date' => $newDate,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0
           ]);

            // study_group_dtl table --insertion

           $hdr_id = $moniter_action->id;
           
          foreach ($request->studentlist as $studentlist) {
           $moniter_action1 = Studygroupdtl::create([
            'study_group_hdr_id'=> $hdr_id,
            'student_id'=>$studentlist,
            'is_active'     =>$request->status,
            'is_deleted'     => 0,
            'created_by'     => Auth::user()->id,
            'updated_by' => 0,
            'deleted_by' => 0
       ]);
    }
          
           // study_group_request table -- updation
            
          
                $affectedRows = Studygrouprequest::where('id', '=', $study_group_id)->update([
               'approval_status'  => 1,
               'approved_by' => Auth::user()->id,
                    
               'approved_at'   => date('Y-m-d'),
              
               'updated_by'     => Auth::user()->id,
              
          ]);
         
           $request->session()->flash('alert-success', 'Study group created successfully');
       
           return Redirect::to('studygrouprequest');
        }
    else{
      
      
        $request->session()->flash('alert-success', 'Could not create study group ');
       
           return Redirect::to('studygrouprequest');
    }

}else{
    abort(403,"You don't have permission to access this page");
}

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Studygrouprequest  $studygrouprequest
     * @return \Illuminate\Http\Response
     */
    public function show(Studygrouprequest $studygrouprequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studygrouprequest  $studygrouprequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Studygrouprequest $studygrouprequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studygrouprequest  $studygrouprequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studygrouprequest $studygrouprequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studygrouprequest  $studygrouprequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studygrouprequest $studygrouprequest)
    {
        //
    }
}
