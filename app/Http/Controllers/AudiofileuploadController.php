<?php

namespace App\Http\Controllers;
use App\User;

use DB;
use Auth;
use Redirect;
use App\Audiofiles;
use Illuminate\Http\Request;
use App\Http\Requests\Audiofiles\StoreAudiofileRequest;
class AudiofileuploadController extends Controller
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
          $data = Audiofiles::where('is_deleted', 0) ->orderBy('id','desc')->get();
          
            return view('audio_uploads.audio_list',compact('data'));
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
            
            return view('audio_uploads.audio_create');
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
    public function store(StoreAudiofileRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
            if(($request->audio_id !="") && ($request->audio_id > 0)){   //update
                $time = date('y-m-d-h-i-s');

               
    
                if($request->hasFile('poster_image_file')) {
                    $file = $request->file('poster_image_file') ;           
                    $poster_image_file = 'posterimg_'.$time.'.'.  $file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/Audiofiles' ;
                    $file->move($destinationPath,$poster_image_file);
                }
                else{
                    $poster_image_file=$request->old_poster_image_file;
                }
                if($request->hasFile('audio_file_name')) {
                    $file_audio = $request->file('audio_file_name');
                    //$audio_length=$file_audio->get('duration');	
                    $audio_file_name = 'audio_'.$time.'.'.  $file_audio->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/Audiofiles' ;
                    $file_audio->move($destinationPath,$audio_file_name);
                }
                else{
                    $audio_file_name=$request->old_audio_file_name;
                }
                $moniter_action = Audiofiles::where('id', '=', $request->audio_id)->update([
                    'audio_file_name' 	=>$audio_file_name,
    				'audio_length' 		=>0,
    				'audio_title' 		=>$request->audio_title,
    				'audio_description' =>$request->audio_description,
    				'poster_image_file' =>$poster_image_file,
    				
                    'updated_by'        => Auth::user()->id,
                    'deleted_by'        =>0
           ]);

           
           $request->session()->flash('alert-success', ' Audio updated successfully');
       
           return Redirect::to('audiofileupload');
            }else{

                $time = date('y-m-d-h-i-s');

                if($request->hasFile('poster_image_file')) {
                    $file = $request->file('poster_image_file') ;           
                    $poster_image_file = 'posterimg_'.$time.'.'.  $file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/Audiofiles' ;
                    $file->move($destinationPath,$poster_image_file);
                }
                else{
                    $poster_image_file='';
                }
                if($request->hasFile('audio_file_name')) {
                    $file_audio = $request->file('audio_file_name') ; 
                    //$audio_length=$file_audio->get('duration');	
                    	
                    $audio_file_name = 'audio_'.$time.'.'.  $file_audio->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/Audiofiles' ;
                    $file_audio->move($destinationPath,$audio_file_name);
                }
                else{
                    $audio_file_name='';
                }
            $moniter_action =  Audiofiles::create([
                'audio_title'		 => $request->audio_title,
                'audio_description' => $request->audio_description,
                'audio_length' 		=> 0,
                'poster_image_file' => $poster_image_file,
                'audio_file_name' 	=> $audio_file_name,
               
                'is_active' 		=>$request->status,
               
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
           ]);
          
           $request->session()->flash('alert-success', ' Audio created successfully');
       
           return Redirect::to('audiofileupload');
            }
          
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Audiofiles  $audiofiles
     * @return \Illuminate\Http\Response
     */
    public function show(Audiofiles $audiofiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Audiofiles  $audiofiles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
        $edit = Audiofiles::where('id',$id)->first();
       
        return view('audio_uploads.audio_create',compact('edit'));
        
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Audiofiles  $audiofiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audiofiles $audiofiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Audiofiles  $audiofiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audiofiles $audiofiles)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
           Audiofiles::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
        return Redirect::to('audiofileupload')
        ->with('alert-success',' Audio
         deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
