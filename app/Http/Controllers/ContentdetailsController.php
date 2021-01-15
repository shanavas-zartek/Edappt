<?php

namespace App\Http\Controllers;
use App\Contentcategory;
use App\ContentDetails;

use App\Subjects;
use Illuminate\Http\Request;
use App\Http\Requests\Contentcategory\StoreContentDetailsRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class ContentdetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){

        $data = ContentDetails::where('content_category_hdr.is_deleted', 0)
        ->join('content_category','content_category_hdr.content_category_id','content_category.id')
        ->join('activity_subject','content_category_hdr.subject_id','activity_subject.id')
        ->select('content_category.category','activity_subject.subject','content_category_hdr.*')
        ->orderBy('id','desc')->get();
        return view('contentdetails.contentdetails_list',compact('data'));
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
        if($user->isAbleTo('activities')){

        $category = Contentcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
        $subject = Subjects::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('contentdetails.contentdetails_create',compact('category','subject'));
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
    public function store(StoreContentDetailsRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('activities')){

        if(($request->hdr_id !="") && ($request->hdr_id > 0)){   //update
            $time = date('y-m-d-h-i-s');

            if($request->hasFile('content_image')) {
                $file = $request->file('content_image') ;
                 $image = 'activity_'.$time.'.'.            $file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/ContentDetails' ;
                $file->move($destinationPath,$image);
            }
            else{
                $image= $request->old_image ;
            }

            $activity_id = $request->hdr_id;
                $affectedRows = ContentDetails::where('id', '=', $activity_id)->update([
                'name'  => ucfirst($request->name),
                'description'   => $request->description,
                'content_category_id'    =>$request->content_category_id,
                'subject_id'      => $request->subject_id,
                'image'        => $image,
                'duration'=> $request->duration,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'updated_by'    => Auth::user()->id,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Content details updated successfully');
       
           return Redirect::to('details');

        }else{
            $time = date('y-m-d-h-i-s');

            if($request->hasFile('content_image')) {
                $file = $request->file('content_image') ;
                 $image = 'activity_'.$time.'.'.            $file->getClientOriginalExtension();

                $destinationPath = public_path().'/uploads/ContentDetails' ;
                $file->move($destinationPath,$image);
            }
            else{
                $image='';
            }

            $moniter_action =   ContentDetails::create([
                'name'  => ucfirst($request->name),
                'description'   => $request->description,
                'content_category_id'    =>$request->content_category_id,
                'subject_id'      => $request->subject_id,
                'image'        => $image,
                'duration'=> $request->duration,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by' =>0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Content details created successfully');
       
           return Redirect::to('details');
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
        if($user->isAbleTo('activities')){
        $edit =  ContentDetails::where('id',$id)->first();
        $category = Contentcategory::where('is_deleted', 0)->orderBy('id','desc')->get();
        $subject = Subjects::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('contentdetails.contentdetails_create',compact('category','subject','edit'));
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
        if($user->isAbleTo('activities')){

        DB::table('content_category_hdr')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('details')
        ->with('alert-success','content details deleted successfully.');
     }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
