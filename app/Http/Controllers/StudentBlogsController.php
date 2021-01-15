<?php

namespace App\Http\Controllers;

use App\Studentblogs;
use Illuminate\Http\Request;
use App\Http\Requests\Studentblogs\StoreStudentBlogsRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class StudentBlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('blogs')){
        $data = StudentBlogs::join( 'student_details', 'student_blogs.student_id', '=', 'student_details.id')
        ->select( 'student_details.first_name',
        'student_details.middle_name',
        'student_details.last_name','student_blogs.*')
        ->where('student_blogs.is_deleted', 0)  ->orderBy('id','desc')
        ->get();
        return view('blogs-student.studentblogs_list',compact('data'));
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
    public function store(StoreStudentblogsRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('blogs')){
        if(($request->student_blog_id !="") && ($request->student_blog_id > 0)){   //update
            $time = date('y-m-d-h-i-s');

           
            $student_blog_id = $request->student_blog_id;
                $affectedRows =StudentBlogs::where('id', '=', $student_blog_id)->update([
               
                'published_from'    =>$request->published_from,
                'published_to'      => $request->published_to,
                'approval_status'  => $request->approval_status,
                'approved_on'   => date('Y-m-d'),
                'approved_by' => Auth::user()->id,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'updated_by'    => Auth::user()->id,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Blogs updated successfully');
       
           return Redirect::to('studentblogs');

        }else{
            $time = date('y-m-d-h-i-s');

            

           
           $request->session()->flash('alert-success', 'Could not Update Blogs');
       
           return Redirect::to('studentblogs');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Studentblogs  $studentblogs
     * @return \Illuminate\Http\Response
     */
    public function show(Studentblogs $studentblogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentblogs  $studentblogs
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
        $user = User::find(Auth::id());
        if($user->isAbleTo('blogs')){
         $edit =  StudentBlogs::join( 'student_details', 'student_blogs.student_id', '=', 'student_details.id')
         ->select('student_details.*','student_blogs.*')
         ->where('student_blogs.id',$id)->where('student_blogs.is_deleted', 0)
         ->first();
         return view('blogs-student.studentblogs_create',compact('edit'));
         ;
        }else{
            abort(403,"You don't have permission to access this page");
        }
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentblogs  $studentblogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentblogs $studentblogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentblogs  $studentblogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentblogs $studentblogs)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('blogs')){
        StudentBlogs::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
        
        return Redirect::to('studentblogs')
        ->with('alert-success','Blogs deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
