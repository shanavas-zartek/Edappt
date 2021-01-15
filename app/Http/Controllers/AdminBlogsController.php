<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminBlogs;
use DB;
use Auth;
use Redirect;
use App\User;
use App\Http\Requests\Blogs\StoreAdminBlogsRequest;

class AdminBlogsController extends Controller
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
        $data = AdminBlogs::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('blogs-admin.blogs_list',compact('data'));
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
        if($user->isAbleTo('blogs')){
        return view('blogs-admin.blogs_create');
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
    public function store(StoreAdminBlogsRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('blogs')){
        if(($request->admin_blog_id !="") && ($request->admin_blog_id > 0)){   //update
            $time = date('y-m-d-h-i-s');

            if($request->hasFile('blog_main_img')) {
                $file = $request->file('blog_main_img') ;
                 $blog_img1 = 'blog_'.$time.'.'.            $file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/blogs' ;
                $file->move($destinationPath,$blog_img1);
            }
            else{
                $blog_img1= $request->image1;
            }
// echo $blog_img1;die;
            if($request->hasFile('blog_sub_img')) {
                $file2 = $request->file('blog_sub_img') ;
                // $blog_img2 = $file->getClientOriginalName() ;
                $blog_img2 = 'blog_'.$time.'.'.            $file2->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/blogs' ;
                $file2->move($destinationPath,$blog_img2);
            
            }
            else{
                $blog_img2= $request->image2;
            }
            $admin_blog_id = $request->admin_blog_id;
                $affectedRows = AdminBlogs::where('id', '=', $admin_blog_id)->update([
                'blog_title'  => ucfirst($request->blog_title),
                'description'   => $request->description,
                'image1'        => $blog_img1,
                'image2'      => $blog_img2,
                'published_from'    =>$request->published_from,
                'published_to'      => $request->published_to,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'updated_by'    => Auth::user()->id,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Blogs updated successfully');
       
           return Redirect::to('adminblogs');

        }else{
            $time = date('y-m-d-h-i-s');

            if($request->hasFile('blog_main_img')) {
                $file = $request->file('blog_main_img') ;
                // $blog_img1 = $file->getClientOriginalName() ;
               
                 $blog_img1 = 'blog_'.$time.'.'.            $file->getClientOriginalExtension();

                $destinationPath = public_path().'/uploads/blogs' ;
                $file->move($destinationPath,$blog_img1);
            }
            else{
                $blog_img1='';
            }

            if($request->hasFile('blog_sub_img')) {
                $file2 = $request->file('blog_sub_img') ;
                // $blog_img2 = $file->getClientOriginalName() ;
                $blog_img2 = 'blog_'.$time.'.'.            $file2->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/blogs' ;
                $file2->move($destinationPath,$blog_img2);
            
            }
            else{
                $blog_img2= '';
            }

            $moniter_action =   AdminBlogs::create([
                'blog_title'  => ucfirst($request->blog_title),
                'description'   => $request->description,
                'image1'        => $blog_img1,
                'image2'      => $blog_img2,
                'published_from'    =>$request->published_from,
                'published_to'      => $request->published_to,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by' =>0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Blogs created successfully');
       
           return Redirect::to('adminblogs');
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
        if($user->isAbleTo('blogs')){
        $edit =  AdminBlogs::where('id',$id)->first();
        return view('blogs-admin.blogs_create',compact('edit'));
        ;
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

    /***Delete Admin blogs***/
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('blogs')){
        AdminBlogs::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
        
        return Redirect::to('adminblogs')
        ->with('alert-success','Blogs deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
