<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RoleRepositoryContract;

use Illuminate\Http\Request;
use App\Http\Requests\userrole\storeUserRoleRequest;
use Redirect;
use Session;
use App\Role;
use App\Permission;
use App\User;
use DB;
class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        // public function __construct()
        // {
        //     $this->middleware('role:admin');
        // }
    public function index()
    { 
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
        $data = Role::where('is_deleted',0) ->orderBy('id','desc')->get();
        return view('userroles.userroles_list',compact('data'));
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
        $exist_permission = array();
        $permissions = Permission::all();
        return view('userroles.userroles_create',compact('permissions','exist_permission'));
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
    public function store(storeUserRoleRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
        $id = $request->role_id;
        if(isset($request->role_id) && $request->role_id !=""){
            $check_row = Role::findorfail($id);

            $editRole = Role::where ('id', $id); 
             if(!is_null($check_row)){
                $affectedRows = Role::where('id', '=', $id)->update([
                    'name'             => strtolower($request->role_name),
                    'display_name'     => ucfirst($request->role_name),
                    'description'      => $request->description,
                    'is_active'           => $request->status
                ]);
                if( $affectedRows){
                     if($request->role_permission){
                        $check_row->syncPermissions($request->role_permission); 
                     }
    
                    $request->session()->flash('alert-success', 'Role updated successfully');
                    
                }
             }
           else{
              $request->session()->flash('alert-warning', 'Failed to Update Role');
           }
           return Redirect::to('userrole');
        }else{

       
        $moniter_action =   Role::create([
            'name'             => strtolower($request->role_name),
            'display_name'     => ucfirst($request->role_name),
            'description'      => $request->description,
            'is_active'           => $request->status
            ]);
        if($moniter_action){
            if($moniter_action->id != ''){
                $store_permission = Role::findorfail($moniter_action->id);
                if($request->role_permission){
                    $store_permission->attachPermissions($request->role_permission); 
                 }
            }
            $request->session()->flash('alert-success', 'Role created successfully');
        }else{
            $request->session()->flash('alert-danger', 'Please Try Later');
        }
        
        return Redirect::to('userrole');
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
    { $user = User::find(Auth::id());
        if($user->isAbleTo('settings')){
        $edit =  Role::where('id',$id)->first();
        $selectroles = Role::where('id', $id)->with('permissions')->first();
        $exist_permission = $selectroles->permissions->pluck('id')->toArray();
        $permissions = Permission::all();
        return view('userroles.userroles_create',compact('permissions','edit','exist_permission'));
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
}
