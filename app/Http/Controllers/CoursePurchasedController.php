<?php

namespace App\Http\Controllers;
use App\Coursemaster;
use App\Agegroup;
use App\Learningcategory;
use App\Vendors;
use App\Coursespurchased;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Redirect;
class CoursePurchasedController extends Controller
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
            
        $data = Coursespurchased::join('course_master','course_master.id','courses_purchased.course_master_id')
        ->join('parent_details','parent_details.id','courses_purchased.parent_id')
        ->join('student_details','student_details.id','courses_purchased.student_id')
        ->select('course_master.id as course_id','course_master.course_name','course_master.course_price','courses_purchased.created_at','courses_purchased.id','parent_details.first_name','parent_details.middle_name','parent_details.last_name','parent_details.id as parent_id','student_details.id as student_id','student_details.first_name as s_fname','student_details.middle_name as s_mname','student_details.last_name as s_lname') 
        ->where('courses_purchased.is_deleted', 0)->orderBy('courses_purchased.id','desc')->get();
        return view('course.course_purchased',compact('data'));
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
    public function details($id)
    { $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
            
            $data = Coursespurchased::join('course_master','course_master.id','courses_purchased.course_master_id')
            ->join('parent_details','parent_details.id','courses_purchased.parent_id')
            ->join('student_details','student_details.id','courses_purchased.student_id')
            ->join('agegroup','course_master.age_group_id','agegroup.id')
            ->join('ld_category','course_master.ld_category_id','ld_category.id')
            ->select('course_master.id as course_id','course_master.description','course_master.course_name','course_master.course_price','courses_purchased.created_at','courses_purchased.id','parent_details.first_name','parent_details.middle_name','parent_details.last_name','parent_details.id as parent_id','parent_details.address','parent_details.email','parent_details.contact_no','student_details.id as student_id','student_details.first_name as s_fname','student_details.middle_name as s_mname','student_details.last_name as s_lname','agegroup.age_group','ld_category.category') 
            ->where(['courses_purchased.is_deleted'=> 0,'courses_purchased.id'=>$id])->orderBy('courses_purchased.id','desc')->first();
            return view('course.purchase_details',compact('data'));
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
