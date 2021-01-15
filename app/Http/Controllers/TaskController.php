<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\Task\StoreTaskRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('task')){

        $data = Task::join( 'agegroup', 'tasks.age_group_id', '=', 'agegroup.id')
       ->select('tasks.*','agegroup.age_group')
       ->where('tasks.is_deleted',0)
       ->orderBy('id','desc')
       ->get();
      
        return view('task.index',compact('data'));
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
        if($user->isAbleTo('task')){
        $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
        
        return view('task.create',compact('age'));
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
    public function store(StoreTaskRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('task')){
        if(($request->task_id !="") && ($request->task_id > 0)){   //update
            $task_id= $request->task_id;
            $images=$request->image;
            $time = date('y-m-d-h-i-s');

            $task_id= $request->task_id;
            $images=$request->image;
            if($file = $request->hasFile('image')) {
            
                $file = $request->file('image') ;
                
                $fileName ='task_'.$time.'.'.           $file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Tasks/' ;
                $file->move($destinationPath,$fileName);
                
            }
            else{
                $fileName=$images;
            }
           
                $affectedRows = Task::where('id', '=', $task_id)->update([
                'task_name' => ucfirst($request->task_name),
                'description'   => $request->description,
                'age_group_id'  => $request->age,
                'image'         =>  $fileName,
                'start_date'         =>  $request->start_date,
                'end_date'         =>  $request->end_date,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,
               
           ]);
          
         
           $request->session()->flash('alert-success', 'Task updated successfully');
       
           return Redirect::to('task');

        }else{
            $time = date('y-m-d-h-i-s');
            if($file = $request->hasFile('image')) {
            
                $file = $request->file('image') ;
                
                $fileName = 'task_'.$time.'.'.           $file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Tasks/' ;
                $file->move($destinationPath,$fileName);
                
            }else{
                $fileName = '';
            }
            
            
            $moniter_action =   Task::create([
           
                'task_name'          => ucfirst($request->task_name),
                'description'   => $request->description,
                
                'age_group_id'   => $request->age,
               'image'         =>  $fileName,
               'start_date'         =>  $request->start_date,
                'end_date'         =>  $request->end_date,
               'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
                
           ]);
           
                  
           $request->session()->flash('alert-success', 'Task created successfully');
       
           return Redirect::to('task');
        } }else{
            abort(403,"You don't have permission to access this page");
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('task')){

        $edit =  Task::where('id',$id)->first();
        $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
       
        return view('task.create',compact('edit','age'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function delete($id){
       $user = User::find(Auth::id());
        if($user->isAbleTo('task')){
        DB::table('tasks')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('task')
        ->with('alert-success','Task deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
