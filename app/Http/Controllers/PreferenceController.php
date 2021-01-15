<?php

namespace App\Http\Controllers;

use App\Preference;
use Illuminate\Http\Request;
use App\Http\Requests\Preference\StorePreferenceRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('preferences')){
        $data = Preference::join( 'agegroup', 'preference_category.age_group_id', '=', 'agegroup.id')
       ->select('preference_category.*','agegroup.age_group')
       ->where('preference_category.is_deleted',0)
       ->orderBy('id','desc')
       ->get();
        return view('preferences.preferences',compact('data'));
        }else{
            abort(403,"You don't have permission to access this page");
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $user = User::find(Auth::id());
        if($user->isAbleTo('preferences')){
        $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
        return view('preferences.preferencecreate',compact('age'));
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
    public function store(StorePreferenceRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('preferences')){
        if(($request->pref_cat_id !="") && ($request->pref_cat_id > 0)){   //update
            $pref_cat_id= $request->pref_cat_id;
            $images=$request->image;
            $time = date('y-m-d-h-i-s');

            if($file = $request->hasFile('image')) {
            
                $file = $request->file('image') ;
            
                $fileName = 'preference_'.$time.'.'.           $file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Preferences/' ;
                $file->move($destinationPath,$fileName);
            
            }
                else{
                    $fileName=$images;
                }
                $affectedRows = Preference::where('id', '=', $pref_cat_id)->update([
                'category_name' => ucfirst($request->category_name),
                'description'   => $request->description,
                'age_group_id'  => $request->age,
                'image'         => $fileName,
                
                
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,
               
           ]);
           
         
           $request->session()->flash('alert-success', 'Preference category updated successfully');
       
           return Redirect::to('preferences');

        }else{
            $time = date('y-m-d-h-i-s');

            if($file = $request->hasFile('image')) {
                $file = $request->file('image') ;
                $fileName ='preference_'.$time.'.'.           $file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Preferences/' ;
                $file->move($destinationPath,$fileName);
                
                
            }else{
                $fileName = '';
            }
            $moniter_action =   Preference::create([
           
                'category_name'          => ucfirst($request->category_name),
                'description'   => $request->description,
                
                'age_group_id'   => $request->age,
               'image'         =>  $fileName,
               'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
           ]);
           
         
           $request->session()->flash('alert-success', 'Preference category created successfully');
       
           return Redirect::to('preferences');
        }
    }else{
            abort(403,"You don't have permission to access this page");
        }
      
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function show(Preference $preference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('preferences')){
        $edit =  Preference::where('id',$id)->first();
        $age = DB::table('agegroup')->where('is_deleted', 0)->pluck("age_group","id");
        return view('preferences.preferencecreate',compact('edit','age'));
        }else{
            abort(403,"You don't have permission to access this page");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preference $preference)
    {
        //
    }
 /***Delete preferences***/
 public function delete($id){
    $user = User::find(Auth::id());
    if($user->isAbleTo('preferences')){
    DB::table('preference_category')
    ->where('id', $id)
    ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
    return Redirect::to('preferences')
    ->with('alert-success','preference category deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
}

}
