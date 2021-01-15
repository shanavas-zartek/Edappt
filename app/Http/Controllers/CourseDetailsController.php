<?php

namespace App\Http\Controllers;
use App\Coursedetails;
use App\Coursemaster;
use DB;
use Auth;
use Redirect;
use App\User;
use App\Http\Requests\CourseDetails\StoreCourseDetailsRequest;

class CourseDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        $data = Coursedetails::join('course_master','course_master.id','course_details.course_master_id')
        ->select('course_master.course_name','course_details.*')
        ->where('course_details.is_deleted', 0)->orderBy('id','desc')->get();
        return view('coursedetails.coursedetails_list',compact('data'));
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
        if($user->isAbleTo('learning_deveopment')){
        $coursemaster = Coursemaster::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('coursedetails.coursedetails_create',compact('coursemaster'));
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
    public function store(StoreCourseDetailsRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        if(($request->id !="") && ($request->id > 0)){   //update
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('video_content_file')) {
                $video_content_file = $request->file('video_content_file') ;
                $filename = 'Course_'.$time.'.'.            $video_content_file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Courses' ;
                $video_content_file->move($destinationPath,$filename);
            }
            else{
                $filename=$request->video_content_file1;
            }              

                $id = $request->id;
                $affectedRows = Coursedetails::where('id', '=', $id)->update([
                    'course_master_id'  => $request->course_master_id,
                    'course_detail_title'  => $request->course_detail_title,
                    'detail_description'   => $request->detail_description,
                    'video_content_file' =>  $filename,
                    'is_active'     => $request->status,
                    'is_deleted'    => 0,
                    'updated_by'    => Auth::user()->id,
                    'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Video updated successfully');
       
           return Redirect::to('coursedetails');

        }else{
           
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('video_content_file')) {
                $video_content_file = $request->file('video_content_file') ;
                $filename = 'Course_'.$time.'.'.            $video_content_file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Courses' ;
                $video_content_file->move($destinationPath,$filename);
            }
            else{
                $filename=$request->video_content_file1;
            }            

            $moniter_action =   Coursedetails::create([
                'course_master_id'  => $request->course_master_id,
                'course_detail_title'  => $request->course_detail_title,
                'detail_description'   => $request->detail_description,
                'video_content_file' =>  $filename,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'updated_by'    => 0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Video uploaded successfully');               
           return Redirect::to('coursedetails');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }        
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
        if($user->isAbleTo('learning_deveopment')){
        $coursemaster = Coursemaster::where('is_deleted', 0)->orderBy('id','desc')->get();
        $edit =  Coursedetails::where('id',$id)->first();
        return view('coursedetails.coursedetails_create',compact('coursemaster','edit'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){
        DB::table('course_details')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('coursedetails')
        ->with('alert-success','Course Video deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
