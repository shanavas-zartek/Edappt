<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Request;
use App\Learningcategory;
use App\LearningContents;
use App\Agegroup;
use DB;
use Auth;
use Redirect;
use App\User;
// use Illuminate\Http\Request;
use App\Http\Requests\Learning\StoreLearningContentRequest;

class LearningController extends Controller
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
        $data = LearningContents::join('ld_category','ld_category.id','ld_contents.category_id')
        ->select('ld_category.category','ld_contents.*')
        ->where('ld_contents.is_deleted', 0)->orderBy('id','desc')->get();
        return view('learning.content_list',compact('data'));
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
        $category = Learningcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('learning.content_create',compact('category'));
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
    public function store(StoreLearningContentRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        if(($request->ld_category_id !="") && ($request->ld_category_id > 0)){   //update

            $time = date('y-m-d-h-i-s');
            if($request->hasFile('ld_file')) {
                $file = $request->file('ld_file') ;
                $file_type= $file->getMimeType();
                 $ld_filename = 'ld_'.$time.'.'.            $file->getClientOriginalExtension();

                $destinationPath = public_path().'/uploads/ld' ;
                $file->move($destinationPath,$ld_filename);
            }
            else{
                $ld_filename=$request->ld_file1;
                $file_type=$request->file_type1;
            }

            $ld_category_id = $request->ld_category_id;
                $affectedRows = LearningContents::where('id', '=', $ld_category_id)->update([
                    'category_id'  => $request->category_id,
                    'description'   => $request->description,
                    'file' =>  $ld_filename,
                    'file_type'=>   $file_type,
                    'is_active'     => $request->status,
                    'is_deleted'    => 0,
                    'updated_by'    => Auth::user()->id,
                    'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'L&D Details updated successfully');
       
           return Redirect::to('development');

        }else{
           
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('ld_file')) {
                $file = $request->file('ld_file') ;
                $file_type= $file->getMimeType();
              
                 $ld_filename = 'ld_'.$time.'.'.            $file->getClientOriginalExtension();

                $destinationPath = public_path().'/uploads/ld' ;
                $file->move($destinationPath,$ld_filename);
            }
            else{
                $ld_filename='';
                $file_type='';
            }



            $moniter_action =   LearningContents::create([
                'category_id'  => $request->category_id,
                'description'   => $request->description,
                'file' =>  $ld_filename,
                'file_type'=>   $file_type,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by' =>0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'L&D details created successfully');
           
           
           return Redirect::to('development');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
        // if(Request::hasFile('ld_audio')){
           
        //     $file = Request::file('ld_audio');
        //     $filename = $file->getClientOriginalName();
        //     $path = public_path().'/uploads/';
        //     return $file->move($path, $filename);
        // }

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
        if($user->isAbleTo('learning_deveopment')){
        $category = Learningcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
        $edit =  LearningContents::where('id',$id)->first();
        return view('learning.content_create',compact('category','edit'));
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
     /***Delete Learning Category***/
     public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('learning_deveopment')){
        LearningContents::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
        return Redirect::to('development')
        ->with('alert-success','L&D details deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
