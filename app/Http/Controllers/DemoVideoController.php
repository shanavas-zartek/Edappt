<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Redirect;
use App\DemoVideo;

use App\Http\Requests\Demovideo\StoreDemoVideoRequest;

class DemoVideoController extends Controller
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
          $data = DemoVideo::where('is_deleted', 0) ->orderBy('id','desc')->get();
            return view('demovideo.demovideo_list',compact('data'));
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
            return view('demovideo.demovideo_create');
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
    public function store(StoreDemoVideoRequest $request)
    {
        
        
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
            if(($request->video_id !="") && ($request->video_id > 0)){   //update
                $time = date('y-m-d-h-i-s');

                if($request->hasFile('demo_video')) {
                    $file = $request->file('demo_video') ;
                     $video = 'demo_'.$time.'.'.            $file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/demovideos' ;
                    $file->move($destinationPath,$video);
                }
                else{
                    $video= $request->old_demo_video;
                }

                $moniter_action = DemoVideo::where('id', '=', $request->video_id)->update([
                    'title'          => $request->title,
                    'file' => $video,
                    'description'   => $request->description,
                    'is_active'     =>$request->status,
                    'is_deleted'     => 0,
                    'updated_by'    => Auth::user()->id,
                    'deleted_by' =>0
           ]);

           
           $request->session()->flash('alert-success', 'Demo video updated successfully');
       
           return Redirect::to('demo');
            }else{

                $time = date('y-m-d-h-i-s');

                if($request->hasFile('demo_video')) {
                    $file = $request->file('demo_video') ;
                     $video = 'demo_'.$time.'.'.            $file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/demovideos' ;
                    $file->move($destinationPath,$video);
                }
                else{
                    $video='';
                }
            $moniter_action =   DemoVideo::create([
                'title'          => $request->title,
                'file' => $video,
                'description'   => $request->description,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
           ]);
          
           $request->session()->flash('alert-success', 'Demo video created successfully');
       
           return Redirect::to('demo');
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
        if($user->isAbleTo('settings')){
        $edit =  DemoVideo::where('id',$id)->first();
        return view('demovideo.demovideo_create',compact('edit'));
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

    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
            DemoVideo::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
        return Redirect::to('demo')
        ->with('alert-success','Demo video deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
