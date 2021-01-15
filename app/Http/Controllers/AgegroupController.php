<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Agegroup\StoreAgegroupRequest;
use App\Agegroup;
use DB;
use Auth;
use Redirect;
use App\User;
class AgegroupController extends Controller
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
        $data = Agegroup::where('is_deleted', 0)->orderBy('id','desc')->get();
        return view('agegroup.agegroup',compact('data'));
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
        return view('agegroup.agegroup_create');
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
    public function store(StoreAgegroupRequest $request)
    { 
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
        if(($request->age_group_id !="") && ($request->age_group_id > 0)){   //update
            $age_group_id = $request->age_group_id;
                $affectedRows = Agegroup::where('id', '=', $age_group_id)->update([
                'age_group'          => ucfirst($request->age_group),
                'description'   => $request->description,
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Agegroup updated successfully');
       
           return Redirect::to('agegroup');

        }else{

            $moniter_action =   Agegroup::create([
           
                'age_group'          => ucfirst($request->age_group),
                'description'   => $request->description,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' =>0
           ]);
           $request->session()->flash('alert-success', 'Agegroup created successfully');
       
           return Redirect::to('agegroup');
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
        $edit =  Agegroup::where('id',$id)->first();
        return view('agegroup.agegroup_create',compact('edit'));
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

     /***Delete agegroup***/
     public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
        Agegroup::where('id', '=', $id)->update([
            'is_deleted'  => 1,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
            return Redirect::to('agegroup')
            ->with('alert-success','Agegroup deleted successfully.');
        
        }else{
        abort(403,"You don't have permission to access this page");
    }

    }
}
