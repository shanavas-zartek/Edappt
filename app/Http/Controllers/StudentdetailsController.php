<?php

namespace App\Http\Controllers;

use App\Studentdetails;
use Illuminate\Http\Request;
use App\Http\Requests\Studentdetails\StoreStudentdetailsRequest;
use DB;
use Auth;
use Redirect;
use App\User;
class StudentdetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $data = Studentdetails::leftJoin( 'countries', 'student_details.country', '=', 'countries.id')
        ->leftJoin('states', 'student_details.state', '=', 'states.id')
        ->leftJoin('cities', 'student_details.city', '=', 'cities.id')
        ->join('parent_details', 'student_details.parent_id', '=', 'parent_details.id')
        ->select('student_details.*','countries.country_name','states.state_name','cities.city_name','parent_details.first_name as pname')
        ->where('student_details.is_deleted', 0)
        ->orderBy('id','desc')
        ->get();
       return view('studentdetails.studentdetailsindex',compact('data'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentdetailsRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        if(($request->student_id !="") && ($request->student_id > 0)){   //update
            $time = date('y-m-d-h-i-s');
            $student_id = $request->student_id;
            $images=$request->image;
            if($file = $request->hasFile('image')) {
            
                $file = $request->file('image') ;
                
                $fileName = 'student_'.$time.'.'.            $file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Students/' ;
                $file->move($destinationPath,$fileName);
                
            }
            else{
                $fileName=$images;
            }
            $affectedRows = Studentdetails::where('id', '=', $student_id)->update([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'middle_name'          => ucfirst($request->middle_name),
                'gender'     => $request->gender,
                'dob'   => $request->dob,
                'grade'=> $request->grade,
                'school'=> $request->school,
                
                'student_code'=> $request->student_code,
                'email'         => $request->email,
                'contact_no'   => $request->contact_no,
                'address'     => $request->address,
                'image'         =>  $fileName,
                
                'district'  => $request->district,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
                'syllabus'   => $request->syllabus,
                'best_friend'=> $request->best_friend,
                'dream'   => $request->dream,
                'pet_name'   => $request->pet_name,
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                
                'deleted_by'     => 0,
           ]);
            
            $request->session()->flash('alert-success', 'Student Details Updated successfully');
       
           return Redirect::to('studentdetails');
        }else{ //insert

            $time = date('y-m-d-h-i-s');
            if($file = $request->hasFile('image')) {
            
                $file = $request->file('image') ;
                
                $fileName =  'student_'.$time.'.'.            $file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Students/' ;
                $file->move($destinationPath,$fileName);
                
            }
            else{
                $fileName=$request->image;
            }
            
            $moniter_action=  Studentdetails::create([
                'first_name'          => ucfirst($request->first_name),
                'last_name'          => ucfirst($request->last_name),
                'middle_name'          => ucfirst($request->middle_name),
                'gender'     => $request->gender,
                'dob'   => $request->dob,
                'grade'=> $request->grade,
                'school'=> $request->school,
                'parent_id'=> $request->parent_id,
                'student_code'=> $request->student_code,
                'email'         => $request->email,
                'contact_no'   => $request->contact_no,
                'address'     => $request->address,
                'image'         =>  $fileName,
                
                'district'  => $request->district,
                'city'         => $request->city,
                'state'   => $request->state,
                'country'         => $request->country,
                'pincode'   => $request->pincode,
                'syllabus'   => $request->syllabus,
                'best_friend'=> $request->best_friend,
                'dream'   => $request->dream,
                'pet_name'   => $request->pet_name,
                'is_active'     => $request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by'     => 0,
           ]);
           $request->session()->flash('alert-success', 'Student Details  created successfully');
       
           return Redirect::to('studentdetail');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    public function getStateList($id)
    {
        $states = DB::table("states")
        ->where("country_id",$id)
        ->where('is_active', 1)
        ->pluck("state_name","id");
        return response()->json($states);
    }
    public function getDistrictList($id)
    {
        $districts = DB::table("districts")
        ->where("state_id",$id)
        ->where('is_active', 1)
        ->pluck("district_name","id");
        return response()->json($districts);
    }
    public function getCityList($id)
    {
        $cities = DB::table("cities")
        ->where("district_id",$id)
        ->where('is_active', 1)
        ->pluck("city_name","id");
        return response()->json($cities);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Studentdetails  $studentdetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        $show = Studentdetails::join( 'countries', 'student_details.country', '=', 'countries.id')
        ->join('states', 'student_details.state', '=', 'states.id')
        ->join('cities', 'student_details.city', '=', 'cities.id')
        ->join('parent_details', 'student_details.parent_id', '=', 'parent_details.id')
        ->join('districts', 'student_details.district', '=', 'districts.id')
        ->select('student_details.*','countries.country_name','states.state_name','districts.district_name','cities.city_name','parent_details.first_name as parentname')
        ->where('student_details.id',$id)->where('student_details.is_deleted', 0)
        ->first();
        
        return view('studentdetails.studentdetailsview',compact('show'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentdetails  $studentdetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){
         
         $edit =Studentdetails::where('id',$id)->first();
       $countries = DB::table("countries")->where('is_active', 1)->pluck("country_name","id");
       $states = DB::table("states")->where("country_id",$edit->country)->where('is_active', 1)->pluck("state_name","id");
       $districts = DB::table("districts")->where("state_id",$edit->state)->where('is_active', 1)->pluck("district_name","id");
       $cities = DB::table("cities")->where("district_id",$edit->district)->where('is_active', 1)->pluck("city_name","id");
       
        return view('studentdetails.studentdetails',compact('edit','countries','states','districts','cities'));
    }else{
        abort(403,"You don't have permission to access this page");
    } 
        
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentdetails  $studentdetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentdetails $studentdetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentdetails  $studentdetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentdetails $studentdetails)
    {
        //
    }
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('student_details')){

        DB::table('student_details')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('studentdetails')
        ->with('alert-success','Student details  deleted successfully.');
     }else{
        abort(403,"You don't have permission to access this page");
    }
    }
}
