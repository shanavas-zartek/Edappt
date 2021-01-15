<?php

namespace App\Http\Controllers;

use App\Optionpolltype;
use Illuminate\Http\Request;
use App\Http\Requests\Optionpolltype\StoreOptionpolltypeRequest;
use DB;
use Auth;
use Redirect;
use App\User;

class OptionpolltypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $user = User::find(Auth::id());
    if($user->isAbleTo('option_polls')){
        $data =Optionpolltype::where('is_deleted', 0) ->orderBy('id','desc')->get();
        return view('optionpolltype.index',compact('data'));
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
    if($user->isAbleTo('option_polls')){
        return view('optionpolltype.create');
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
    public function store(StoreOptionpolltypeRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
        if(($request->type_id !="") && ($request->type_id > 0)){   //update
            $type_id= $request->type_id;
          
                $affectedRows = Optionpolltype::where('id', '=', $type_id)->update([
                'type' => ucfirst($request->type),
                'description'   => $request->description,
                
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,
           ]);
               
          
           
         
           $request->session()->flash('alert-success', 'Option poll type updated successfully');
       
           return Redirect::to('optionpolltype');

        }else{

            $moniter_action =   Optionpolltype::create([
                'type'          => ucfirst($request->type),
                'description'   => $request->description,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
           ]);
          
           $request->session()->flash('alert-success', 'Option poll type created successfully');
       
           return Redirect::to('optionpolltype');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Optionpolltype  $optionpolltype
     * @return \Illuminate\Http\Response
     */
    public function show(Optionpolltype $optionpolltype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Optionpolltype  $optionpolltype
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {  $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
         $edit = Optionpolltype::where('id',$id)->first();
         return view('optionpolltype.create',compact('edit'));
        }else{
            abort(403,"You don't have permission to access this page");
        }
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Optionpolltype  $optionpolltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Optionpolltype $optionpolltype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Optionpolltype  $optionpolltype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Optionpolltype $optionpolltype)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
        DB::table('option_poll_types')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('optionpolltype')
        ->with('alert-success','Option poll type deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
