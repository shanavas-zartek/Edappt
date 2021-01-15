<?php

namespace App\Http\Controllers;
use App\User;
use App\Learningcategory;
use App\LearningContents;
use App\Agegroup;
use DB;
use Auth;
use Redirect;
use App\Videofiles;
use Illuminate\Http\Request;
use App\Http\Requests\Videofiles\StoreVideofileRequest;

class VideofileuploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
          $data = Videofiles::where('is_deleted', 0) ->orderBy('id','desc')->get();
          
            return view('video_uploads.video_list',compact('data'));
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
        if($user->isAbleTo('settings')){
            $category = Learningcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
            $agegroup = Agegroup::where('is_deleted', 0)->orderBy('id','desc')->get();
            return view('video_uploads.video_create',compact('category','agegroup'));
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
    public function store(StoreVideofileRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
            if(($request->video_id !="") && ($request->video_id > 0)){   //update
                $time = date('y-m-d-h-i-s');

               
    
                if($request->hasFile('poster_image_file')) {
                    $file = $request->file('poster_image_file') ;           
                    $poster_image_file = 'posterimg_'.$time.'.'.  $file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/Videofiles' ;
                    $file->move($destinationPath,$poster_image_file);
                }
                else{
                    $poster_image_file=$request->old_poster_image_file;
                }
                if($request->hasFile('video_file_name')) {
                    $file_video = $request->file('video_file_name');
                    //$video_length=$file_video->getSize();
                    $video_file_name = 'video_'.$time.'.'.  $file_video->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/Videofiles' ;
                    $file_video->move($destinationPath,$video_file_name);
                }
                else{
                    $video_file_name=$request->old_video_file_name;
                }
                $moniter_action = Videofiles::where('id', '=', $request->video_id)->update([
                    'video_file_name' 	=>$video_file_name,
    				'video_length' 		=>0,
    				'video_title' 		=>$request->video_title,
    				'video_description' =>$request->video_description,
    				'poster_image_file' =>$poster_image_file,
    				'category_id'		=>$request->category_id,
    				'age_group_id'		=>$request->age_group_id,
                   
                    'updated_by'        => Auth::user()->id,
                    'deleted_by'        =>0
           ]);

           
           $request->session()->flash('alert-success', ' video updated successfully');
       
           return Redirect::to('videofileupload');
            }else{

                $time = date('y-m-d-h-i-s');

                if($request->hasFile('poster_image_file')) {
                    $file = $request->file('poster_image_file') ;           
                    $poster_image_file = 'posterimg_'.$time.'.'.  $file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/Videofiles' ;
                    $file->move($destinationPath,$poster_image_file);
                }
                else{
                    $poster_image_file='';
                }
                if($request->hasFile('video_file_name')) {
                    $file_video = $request->file('video_file_name') ; 
                   // $video_length=$file_video->getSize();		
                    $video_file_name = 'video_'.$time.'.'.  $file_video->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/Videofiles' ;
                    $file_video->move($destinationPath,$video_file_name);
                }
                else{
                    $video_file_name='';
                }
            $moniter_action =  Videofiles::create([
                'video_title'		 => $request->video_title,
                'video_description' => $request->video_description,
                'video_length' 		=> 0,
                'poster_image_file' => $poster_image_file,
                'video_file_name' 	=> $video_file_name,
                'category_id'		=>$request->category_id,
                'age_group_id'		=>$request->age_group_id,
                'is_active' 		=>$request->status,
               
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
           ]);
          
           $request->session()->flash('alert-success', ' video created successfully');
       
           return Redirect::to('videofileupload');
            }
          
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Videofiles  $videofiles
     * @return \Illuminate\Http\Response
     */
    public function show(Videofiles $videofiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Videofiles  $videofiles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
        $edit =  Videofiles::where('id',$id)->first();
        $category = Learningcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
        $agegroup = Agegroup::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('video_uploads.video_create',compact('edit','category','agegroup'));
        
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Videofiles  $videofiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videofiles $videofiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Videofiles  $videofiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videofiles $videofiles)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
            Videofiles::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
        return Redirect::to('videofileupload')
        ->with('alert-success',' video deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
