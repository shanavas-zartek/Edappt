<?php

namespace App\Http\Controllers;
use App\Coursemaster;
use App\Agegroup;
use App\Learningcategory;
use App\Vendors;
use App\User;
use DB;
use Auth;
use Redirect;
use App\Http\Requests\Course\StoreCourseRequest;

class CourseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        $data = Coursemaster::join('ld_category','course_master.ld_category_id','ld_category.id')
        ->join('agegroup','course_master.age_group_id','agegroup.id')
        ->join('vendor_details','course_master.vendor_id','vendor_details.id')
        ->select('course_master.*','ld_category.category','agegroup.age_group','vendor_details.first_name')        
        ->where('course_master.is_deleted', 0)->orderBy('id','desc')->get();
        return view('course.course_list',compact('data'));
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
        $agegroup = Agegroup::where('is_deleted', 0)->orderBy('id','desc')->get();
        $ldcategory = Learningcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
        $vendors = Vendors::where('is_deleted', 0)->orderBy('id','desc')->get();           
        return view('course.course_create',compact('agegroup','ldcategory','vendors'));
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
    public function store(StoreCourseRequest $request)
    {        
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        if(($request->id !="") && ($request->id > 0)){   //update
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('poster_image')) {
                $poster_image = $request->file('poster_image') ;
                $filename = 'Course_'.$time.'.'.            $poster_image->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Courses' ;
                $poster_image->move($destinationPath,$filename);
            }
            else{
                $filename=$request->poster_image1;
            }            
            
            $id = $request->id;
                $affectedRows = Coursemaster::where('id', '=', $id)->update([
                    'course_name'  => $request->course_name,
                    'ld_category_id'  => $request->ld_category_id,
                    'age_group_id'  => $request->age_group_id,
                    'vendor_id'  => $request->vendor_id,
                    'description'   => $request->description,
                    'poster_image' =>  $filename,
                    'course_price'   => $request->course_price,
                    'is_active'     => $request->status,
                    'is_deleted'    => 0,
                    'updated_by'    => Auth::user()->id,
                    'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Course Details updated successfully');
           return Redirect::to('course');

        }else{
           
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('poster_image')) {
                $poster_image = $request->file('poster_image') ;
                $filename = 'Course_'.$time.'.'.            $poster_image->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Courses' ;
                $poster_image->move($destinationPath,$filename);
            }
            else{
                $filename=$request->poster_image1;
            }

            $moniter_action =   Coursemaster::create([
                'course_name'  => $request->course_name,
                'description'   => $request->description,
                'ld_category_id'  => $request->ld_category_id,
                'age_group_id'  => $request->age_group_id,
                'vendor_id'  => $request->vendor_id,
                'poster_image' =>  $filename,
                'course_price' =>  $request->course_price,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by' =>0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Course details created successfully');                      
           return Redirect::to('course');
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
        $agegroup = Agegroup::where('is_deleted', 0)->orderBy('id','desc')->get();
        $ldcategory = Learningcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
        $vendors = Vendors::where('is_deleted', 0)->orderBy('id','desc')->get();
        $edit =  Coursemaster::where('id',$id)->first();
        return view('course.course_create',compact('ldcategory','agegroup','vendors','edit'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){
        DB::table('course_master')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('course')
        ->with('alert-success','Course deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

}
