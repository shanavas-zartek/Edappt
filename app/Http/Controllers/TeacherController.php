<?php

namespace App\Http\Controllers;
use App\Teacher;
use App\TeacherOnDemand;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Teachers\StoreTeacherRequest;
use DB;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Hash;
use App\Role;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_on_demand')){
        $data = Teacher::join( 'agegroup', 'teachers.age_group_id', '=', 'agegroup.id')
        ->select('teachers.*','agegroup.age_group')
       ->where('teachers.is_deleted',0) ->orderBy('id','desc')
       ->get();
       
        return view('teacher.requested_teachers',compact('data'));
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
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_on_demand')){
        $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
        $countries = DB::table("countries") ->where('is_active', 1)->pluck("country_name","id");
        return view('teacher.teachers_create',compact('age','countries'));
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
    public function store(StoreTeacherRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_on_demand')){
        $role_id =   Role::where('name','teacher')->first();
       
        if($request->teacher_id !=""){   //update
            $teacher_id = $request->teacher_id;
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('resume')) {
                $file = $request->file('resume') ;
                 $resume = 'resume_'.$time.'.'.            $file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Teachers' ;
                $file->move($destinationPath,$resume);
            }
            else{
                $resume = $request->old_resume;
            }
            $affectedRows = Teacher::where('id', '=', $teacher_id)->update([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'phone'   => $request->phone,
                'address'     => $request->address,
                'gender'     => $request->gender,
                'age_group_id'  => $request->age,
                'district'  => $request->district,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
                'dob'   => $request->dob,
                'qualification'         => $request->qualification,
                'subject'   => $request->subject,
                'experience'   => $request->experience,
                'resume' => $resume,
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,
           ]);
          
           if(!empty($request->password)){    
            $password = Hash::make($request->password);
           }else{
            $password = $request->old_password;
           }

          $userdata =  User::where('teacher_id', '=', $teacher_id)->update([
            'name'          => $request->first_name." ".$request->last_name,
            'email'         => $request->email,
            'password' =>  $password]);
            $teachers_user_id = 
        
            $request->session()->flash('alert-success', 'Teacher Updated successfully');
                
           return Redirect::to('teacher');
        }else{ //insert
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('resume')) {
                $file = $request->file('resume') ;
                 $resume = 'resume_'.$time.'.'.            $file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Teachers' ;
                $file->move($destinationPath,$resume);
            }
            else{
                $resume='';
            }
            $moniter_action=   Teacher::create([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'email'         => $request->email,
                'phone'   => $request->phone,
                'address'     => $request->address,
                'gender'     => $request->gender,
                'age_group_id'  => $request->age,
                'city'         => $request->city,
                'district'  => $request->district,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
                'dob'   => $request->dob,
                'qualification'         => $request->qualification,
                'subject'   => $request->subject,
                'experience'   => $request->experience,
                'resume' => $resume,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by'     => 0,
           ]);
          if($moniter_action){
              // User of type teacher 
              $password =  Hash::make($request->password);
              $userdata =  User::create([
                'name'          => $request->first_name." ".$request->last_name,
                'email'         => $request->email,
                'is_admin'      => 0,
                'teacher_id' => $moniter_action->id,
                'role_id' => $role_id->id,
                'password' =>  $password]);
                $user_role = User::findorfail($userdata->id);
                // attach the user role section admin role
                  
                $user_role->attachRole($role_id->id); 

          }
           $request->session()->flash('alert-success', 'Teacher created successfully');
       
           return Redirect::to('teacher');
    }
}else{
    abort(403,"You don't have permission to access this page");
}
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
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_on_demand')){

        $edit = Teacher::where('teachers.id',$id)->
        select('teachers.*','users.password')->join('users','teachers.id','users.teacher_id')->first();
       
        $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id"); 
        $countries = DB::table("countries") ->where('is_active', 1)->pluck("country_name","id");
       
        $states = DB::table("states")->where("country_id",$edit->country) ->where('is_active', 1)->pluck("state_name","id");
 
        $districts = DB::table("districts")->where("state_id",$edit->state)->where('is_active', 1)->pluck("district_name","id");
        $cities = DB::table("cities")->where("district_id",$edit->district)->where('is_active', 1)->pluck("city_name","id");
        return view('teacher.teachers_create',compact('edit','age','countries','states','districts','cities'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_requests')){
        $today = date('Y-m-d');
        $allrequests = TeacherOnDemand::where('teacher_id',Auth::user()->teacher_id)->where('is_deleted',0)->count();
       
        $pending =  count(DB::select("select * from teacher_on_demand WHERE timestamp(approved_start_date,approved_start_time) < NOW() AND teacher_id = ".Auth::user()->teacher_id." AND is_deleted = 0"));

        return view('teacher.dashboard',compact('allrequests','pending'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    public function ondemand()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_requests')){

        $id = Auth::user()->teacher_id; 
		
		$data = DB::select("select teacher_on_demand.id,teacher_on_demand.student_id,teacher_on_demand.subject,teacher_on_demand.question,
		teacher_on_demand.requested_date,teacher_on_demand.requested_time,teacher_on_demand.approval_status,teacher_on_demand.is_active,
		teacher_on_demand.is_deleted,
		
student_details.first_name,student_details.last_name
 from teacher_on_demand
INNER JOIN student_details
        ON teacher_on_demand.student_id = student_details.id

 where teacher_on_demand.subject = (Select subject from teachers where id = $id) 
 AND teacher_on_demand.is_active = 1 AND teacher_on_demand.is_deleted = 0");
		
		
       /* $data =  TeacherOnDemand::join( 'teachers', 'teachers.id', '=', 'teacher_on_demand.teacher_id')
        ->join('student_details','teacher_on_demand.student_id', '=','student_details.id')
        ->select('teacher_on_demand.*','teachers.first_name as fname','teachers.last_name as lname','student_details.first_name','student_details.middle_name','student_details.last_name')
        ->where('teacher_on_demand.teacher_id',$id)
        ->where('teacher_on_demand.is_deleted',0)
        ->get();*/
       
        return view('teacher.teacher_on_requests',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    public function approve_demand($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_requests')){

        $data =  TeacherOnDemand::join('student_details','teacher_on_demand.student_id', '=','student_details.id')
        ->select('teacher_on_demand.*','student_details.first_name','student_details.middle_name','student_details.last_name')
        ->where('teacher_on_demand.id',$id)
        ->where('teacher_on_demand.is_deleted',0)
        ->first();
        return view('teacher.approve_teacher_on_demand',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    public function approve(Request $request){
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_requests')){

        $id = $request->id;
		$teacher_id = Auth::user()->teacher_id; 
       $action =  TeacherOnDemand::where('id', '=', $id)->update([
			'teacher_id'			=>$teacher_id,
            'approved_start_date'    =>$request->start_date,
            'approved_start_time'   => $request->start_time,
            'approval_status'         => 1,
            'approved_on'   => date('Y-m-h h:i:s'),
            'approved_by' => Auth::user()->id]);
            
       if($action){
        $request->session()->flash('alert-success', 'Teacher on demand updated successfully');
       }else{
        $request->session()->flash('alert-error', 'Failed to Update teacher requests ');
       }
            return Redirect::to('ondemand');
        }else{
            abort(403,"You don't have permission to access this page");
        }
    }

    public function requested()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_on_demand')){

        $data =  TeacherOnDemand::join( 'teachers', 'teachers.id', '=', 'teacher_on_demand.teacher_id')
        ->join('student_details','teacher_on_demand.student_id', '=','student_details.id')
        ->select('teacher_on_demand.*','teachers.first_name as fname','teachers.last_name as lname','student_details.first_name','student_details.middle_name','student_details.last_name')
       ->where('teacher_on_demand.is_deleted',0)
       ->get();

        return view('teacher.requests',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
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
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_on_demand')){

        Teacher::where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('teacher')
        ->with('alert-success','Teacher details deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    public function delete_teacherdemand($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('teacher_on_demand')){

        TeacherOnDemand::where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('requested')
        ->with('alert-success','Teacher request deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
