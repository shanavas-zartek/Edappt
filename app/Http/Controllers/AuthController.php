<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Parentdetail;
use App\Appusers;
use App\Studentdetails;
use App\Learningcategory;
use App\Agegroup;
use App\Planneritem;
use App\Postings;
use App\States;
use App\City;
use App\District;
use App\Country;
use App\Mydiary;
use App\Myfolderstructure;
use App\Myfiles;
use App\Audiofiles;
use App\Audiolistenhistory;
use App\Videofiles;
use App\Videowatchedhistory;
use App\Studygroup;
use App\Studygrouprequest;
use App\Questions;
use App\Answers;
use App\ContentDetails;
use App\Payments;
use App\Pointtransactions;
use App\Coursemaster;
use App\Coursedetails;
use App\Coursespurchased;
use App\StudentPuzzles;
use App\Studenttask;
use App\Task;
use App\OptionpollQuestions;
use App\OptionpollAnswers;
use App\Studentopinion;
use App\Magazine;
use App\Studentblogs;
use App\Vendorcategory;
use App\Vendors;
use App\TeacherOnDemand;
use App\Teachers;
use App\Studentqueries;
use App\Contentcategory;
use App\Studentgoals;
use App\TimetableDetails;
use App\Timetable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        // abort(500,'Something went wrong');
        /*
        $validator = Validator::make($request->all(), [
            'parent_name' => 'required',
            'contact_number' => 'required|unique:parent_details,contact_no|digits:10',
            'email' => 'required|email|unique:parent_details,email'
        ]);
        */
        
        $validator = Validator::make($request->all(), [
            'parent_name' => 'required',
            'contact_number' => 'required|unique:parent_details,contact_no|digits:10',
            'email' => 'unique:parent_details',
            // 'mac_address' => 'required|unique:parent_details'
        ]);

       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       

        $user = new Parentdetail([
            'first_name' => $request->parent_name,
            'contact_no' => $request->contact_number,
            'email' => $request->email,
            // 'mac_address' => $request->mac_address,
            'is_Active' => 1
        ]);
        if($user->save()){
            // checking the contact number exist in vendor
            
            $check =  Vendors::where('phone',$request->contact_number)->first();
            if(isset($check->phone) && ($check->phone != ''))
            {
                $vendor_id = $check->id;
                // update vendor id in parent table
                $affectedRows = Parentdetail::where('id', '=', $user->id)->update([
                    'vendor_id'          =>  $vendor_id,
                ]);
            }else{
                $vendor_id =0;
            }

            return response()->json([
                'message' => 'Successfully created parent!',
                'code' => 201  ,
                'parent_id' => $user->id,
                'vendor_id' => $vendor_id    
            ]);
        }
        else {
            return response()->json([
                'message' => 'Failed to create parent!',
                'code' => 400
            ]);
        }
        
        // THERE IS A FLOW CHANGE FROM CLIENT. 
        // FIRST, NEED TO CREATE A PARENT, AND AFTER PAYMENT IS DONE, WILL CREATE A PASSWORD
        /*
        if($user->save()){
        $userdet = new Appusers(['parent_id'=>$user->id,
        'username'=> $request->contact_number,
        'password'=>Hash::make($request->password),
        'is_active' => 1]);
        $userdet->save();
        return response()->json([
                    'message' => 'Successfully created parent!',
                    'code' => 201  ,
                    'parent_id' => $user->id         
                ]);
        }else{
            return response()->json([
                'message' => 'Failed to create parent!',
                'code' => 400
            ]);
        }
        */
       
    }
    
    
    public function create_pin(Request $request){
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
            'password' => 'required',
            'contact_number' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $userdet = new Appusers(['parent_id'=>$request->parent_id,
        'username'=> $request->contact_number,
        'password'=>Hash::make($request->password),
        'is_active' => 1]);
        
        if($userdet->save()){
            return response()->json([
                'message' => 'Successfully created pin!',
                'code' => 201  ,
                'parent_id' => $request->parent_id
            ]);
        }
        else {
            return response()->json([
                'message' => 'Failed to update pin!',
                'code' => 400
            ]);
        }
    }
    
  
  public function parent_details(Request $request){

    $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'state' => 'required',
        'district' => 'required',
        'city'=> 'required',
        'address'=> 'required',
        'pincode'=> 'required',
        'phone'=> 'required',
        'parent_id'=> 'required',
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
   $parent_id = $request->parent_id;

    $affectedRows = Parentdetail::where('id', '=', $parent_id)->update([
        'first_name'          => $request->first_name,
        'last_name'          => $request->last_name,
        'contact_no'   => $request->phone,
        'address'     => $request->address,
        'country' => 1,
        'district'  => $request->district,
        'city'         => $request->city,
        'state'   => $request->state,
        'pincode'   => $request->pincode,
        'alternate_no'   => $request->alternate_no,
        'is_Active' => 1
   ]);
   if($affectedRows){
    return response()->json([
        'message' => 'Parent details successfully updated',
        'code' => 201       
    ]);
    }else{
        return response()->json([
            'message' => 'Failed to update parent details',
            'code' => 400
        ]);
    }
  }
  
  
  
  public function check_duplicate_mobile(Request $request) {
      $validator = Validator::make($request->all(), [
        'contact_no'=> 'required',
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    
    $contact_no = $request->contact_no;
    
    return response()->json(Parentdetail::where('contact_no', '=', $contact_no)->get());
    
  }
  
  public function check_duplicate_email_phone(Request $request) {
      $validator = Validator::make($request->all(), [
        'email'=> 'required',
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    
    $email = $request->email;
    $contact_no = $request->contact_no;
    
    return response()->json(Parentdetail::where('email', '=', $email)->orWhere('contact_no', '=', $contact_no)->get());
}
  
  public function update_password(Request $request) {
      $validator = Validator::make($request->all(), [
        'username'=> 'required',
        'password'=> 'required',
    ]);
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    
    $username = $request->username;
    $affectedRows = Appusers::where('username', '=', $username)->update([
        'password'          => Hash::make($request->password)
   ]);
   
   return response()->json([
                    'message' => 'Successfully updated password!',
                    'code' => 201    
                ]);
   
  }
  
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_number' => 'required|digits:10',
            'password' => 'required|string',
            // 'mac_address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
       $check =  Appusers::where('username',$request->contact_number)->first();
       if(isset($check->password) && ($check->password != ''))
       {
        $dataa = Hash::check($request->password, $check->password);
        if( $dataa == true){
          
            $parentDetails = Parentdetail::where('id', $check->parent_id)->first();
             // update Macaddresses
            // if(empty($parentDetails->mac_address2) && empty($parentDetails->mac_address3)) { 
            //     Parentdetail::where('id', '=', $check->parent_id)->update([
            //         'mac_address2'   => $request->mac_address
            //     ]);
            // }
            // elseif(empty($parentDetails->mac_address3)) {
            //     Parentdetail::where('id', '=',  $check->parent_id)->update([
            //         'mac_address3'   => $request->mac_address
            //     ]);
            // }
           // Check Macaddresses
        //   if($parentDetails->where('mac_address',$request->mac_address)->orwhere('mac_address2',$request->mac_address)->orwhere('mac_address3',$request->mac_address)->count()==0){
        //     return response()->json([
        //         'message' => 'Unauthorised Access. This Mac address is not registered with us.',
        //         'code' => 400
        //     ]); 
        //   }else{
            return response()->json([
                $parentDetails
            ]);
        //   }
            
            /*
            return response()->json( Parentdetail::where('id', $check->parent_id)->first()) ;
            */
        }else{
            return response()->json([
                'message' => 'The contact number or password is incorrect',
                'code' => 400
            ]);
        }
       
       }else{
        return response()->json([
            'message' => 'The contact number is not registered with eadppt',
            'code' => 400
        ]);
       }
       
    }
    public function student_details(Request $request){

        $validator = Validator::make($request->all(), [
            'parent_id' => 'required|integer',
            'first_name' => 'required',
            // 'profile_pic' => 'mimes:jpeg,bmp,png,gif,jpg|size:20000',
           
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $time = date('y-m-d-h-i-s');
        if($request->id == 0) {
        if($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic') ;           
            $post_image = 'img_'.$time.'.'.  $file->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/Students' ;
            $file->move($destinationPath,$post_image);
        }
        else{
            $post_image='';
        }
        $check = Studentdetails::where(['parent_id'=>$request->parent_id,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'is_deleted'=>0,'is_active'=>1])->get();
        if(count($check) > 0){
            return response()->json([
                'message' => 'Student details already exists for this parent',
                'code' => 400
            ]);
        }else{
            
            $studentData = new Studentdetails([
                "parent_id" => $request->parent_id,
                "age_group_id" => $request->age_group_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'grade' => $request->grade,
                'syllabus'=>$request->syllabus,
                'best_friend'=>$request->best_friend,
                'dream'=>$request->dream,
                'pet_name'=>$request->pet_name,
                'dob'=>$request->dob,
                'age'=>$request->age,
                'my_hero'=>$request->my_hero,
                'color'=>$request->color,
                'subject'=>$request->subject,
                'food'=>$request->food,
                'teacher'=>$request->teacher,
                'hobby'=>$request->hobby,
                'passtime'=>$request->passtime,
                'about_me'=> $request->about_me,
                'image' => $post_image,
                'is_active' => 1
            ]);
            if($studentData->save()){
                $student_id =  $studentData->id  ;
                $studentCode = str_pad( $student_id, 4, '0', STR_PAD_LEFT);
                $code = 'EDT'.date("Y"). $studentCode;
                $affectedRows = Studentdetails::where('id', '=',  $student_id)->update([
                    'student_code'   => $code
                ]);
                return response()->json([
                    'message' => 'Successfully created student!',
                    'code' => 201  ,
                    'student_id' =>  $student_id,
                    'student_code' =>    $code   
                ]);
            }else{
                return response()->json([
                    'message' => 'Failed to create student!',
                    'code' => 400,
                    'student_id' => 0,
                    'student_code' => '0'
                ]);
            }
        }
    }else{
        if($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic') ;           
            $post_image = 'img_'.$time.'.'.  $file->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/Students' ;
            $file->move($destinationPath,$post_image);
        }
        else{
            $post_image= $request->old_image;
        }
        Studentdetails::where('id', '=',  $request->id)->update([
            "parent_id" => $request->parent_id,
            "age_group_id" => $request->age_group_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'grade' => $request->grade,
            'syllabus'=>$request->syllabus,
            'best_friend'=>$request->best_friend,
            'dream'=>$request->dream,
            'pet_name'=>$request->pet_name,
            'dob'=>$request->dob,
            'age'=>$request->age,
            'my_hero'=>$request->my_hero,
            'color'=>$request->color,
            'subject'=>$request->subject,
            'food'=>$request->food,
            'teacher'=>$request->teacher,
            'hobby'=>$request->hobby,
            'passtime'=>$request->passtime,
            'about_me'=> $request->about_me,
            'image' => $post_image,
        ]);
        return response()->json([
            'message' => 'Successfully updated student!',
            'code' => 201  
            
        ]);
    }
    }
    
    public function login_using_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $check = Parentdetail::where('email', $request->email)->first();
        if(isset($check->email) && ($check->email != '')) {
            return response()->json($check);
        } else {
            return response()->json([
                'message' => 'The user is not registered with My Eadppt',
                'code' => 400
            ]);
       }
        
    }
    
    public function save_student_image(Request $request) {
        if ($request->hasFile('file')){
            $image = $request->file('file');
            $name = $image->getClientOriginalName();                    
            //$destinationPath = public_path('/images/student/profile');
            $destinationPath = public_path().'/uploads/Students' ;
            $image->move($destinationPath, $name);
            
            $st_id = $request->student_id;
            $affectedRows = Studentdetails::where('id', '=',  $st_id)->update([
                    'image'   => $name
                ]);
                
            return response()->json([
                'message' => 'Image update',
                'filename' => $destinationPath.$name,
                'code' => 201
            ]);
            
            
        }
        else {
            return response()->json([
                'message' => 'The user is not registered with My Eadppt',
                'code' => 400
            ]);
        }
    }

    public function category_details(){
        $show= Learningcategory::where(['is_deleted'=>0,'is_active' => 1])->select('id','category','age_group_id')->orderBy('id','desc')->get();
        return  json_encode($show);
    }
    
    public function age_group_list(){
        $show= Agegroup::where(['is_deleted'=>0,'is_active' => 1])->select('id','age_group', 'description')->orderBy('id','desc')->get();
        return  json_encode($show);
    }
    
    public function student_list(Request $request){
        
        
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       
        
        if($request->student_id == 0){
            $show= Studentdetails::where(['parent_id'=>$request->parent_id, 'is_deleted'=>0,'is_active' => 1])->select('*')->orderBy('first_name','desc')->get();
        }else{
            $show= Studentdetails::where(['parent_id'=>$request->parent_id,'id'=>$request->student_id, 'is_deleted'=>0,'is_active' => 1])->select('*')->orderBy('first_name','desc')->first();
           
           
        }
      
        return  json_encode($show);
        
    }
    
    public function save_planner_item(Request $request){
       
       // If id is 0, it will be an insert, else, it will be an update
       
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'student_id' => 'required|integer',
            'planner_item_name' => 'required',
            'planned_date' => 'required',
           
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        
        if($request->id == 0) {
            $plannerItem = new Planneritem([
                "student_id" => $request->student_id,
                "planner_item_name" => $request->planner_item_name,
                "planned_date" => $request->planned_date,
                "status" => $request->status,
                "is_active" => 1
                ]);
                
            if($plannerItem->save()){
                $planner_id =  $plannerItem->id  ;
                
                return response()->json([
                    'message' => 'Your paln details successfully saved!',
                    'code' => 201  ,
                    'planner_id' =>  $planner_id 
                ]);
            }else{
                return response()->json([
                    'message' => 'Failed to create planner item!',
                    'code' => 400,
                    'planner_id' => 0
                ]);
            }
        }
        else {
            Planneritem::where('id', '=',  $request->id)->update([
                    'planner_item_name'   => $request->planner_item_name,
                    'planned_date'   => $request->planned_date,
                    'status'   => $request->status
                ]);
                
            return response()->json([
                    'message' => 'Updated!',
                    'code' => 201  ,
                    'planner_id' =>  $request->id
                ]);
        }
        
        
        
    }
    
    public function get_planner_list(Request $request) {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer'
        ]);   
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $show= Planneritem::where(['student_id'=>$request->student_id])->select('id', 'student_id', 'planner_item_name','planned_date', 'status')->orderBy('id','desc')->get();
        return  json_encode($show);
        
    }
    public function edit_planner_item(Request $request){
        // echo $request->id;die;
        $data =  Planneritem::where('id',$request->id)->where('is_deleted',0)->first();
        return  json_encode($data);
    }

   
    // save student posts commentes syamili on sep14
    // public function create_student_post(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'student_id' => 'required|integer',
    //         'category_id' => 'required',
    //         'post_name' => 'required',
    //         // 'post_image' => 'mimes:jpeg,bmp,png,gif,jpg|size:20000',
    //         // 'post_video' => 'mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv| max:40000'
    //     ]);   
        
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }
       
    //     $time = date('y-m-d-h-i-s');

    //     if($request->hasFile('post_image')) {
    //         $file = $request->file('post_image') ;           
    //         $post_image = 'postimg_'.$time.'.'.  $file->getClientOriginalExtension();
    //         $destinationPath = public_path().'/uploads/StudentPostings' ;
    //         $file->move($destinationPath,$post_image);
    //     }
    //     else{
    //         $post_image='';
    //     }
    //     if($request->hasFile('post_video')) {
    //         $file_video = $request->file('post_video') ;           
    //         $video = 'video_'.$time.'.'.  $file_video->getClientOriginalExtension();
    //         $destinationPath = public_path().'/uploads/StudentPostings' ;
    //         $file_video->move($destinationPath,$video);
    //     }
    //     else{
    //         $video='';
    //     }

    //     $postData = new Postings([
    //         "student_id" => $request->student_id,
    //         "category_id" => $request->category_id,
    //         'topic' => $request->post_name,
    //         'post_image' => $post_image,
    //         'post_video' => $video,
    //         'is_active' => 1
    //     ]);
        
     
    //     if($postData->save()){
    //         $post_id =  $postData->id  ;
            
    //         return response()->json([
    //             'message' => 'Your post successfully saved!',
    //             'code' => 201  ,
    //             'post_id' =>  $post_id 
    //         ]);
    //     }else{
    //         return response()->json([
    //             'message' => 'Failed to create post!',
    //             'code' => 400,
    //             'post_id' => 0
    //         ]);
    //     }
    // }
     // List student posts
	 
	 
   public function get_posts_list(Request $request) {
    $validator = Validator::make($request->all(), [
        'student_id' => 'required|integer'
    ]);   
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    
    $show= Postings::where(['student_id'=>$request->student_id])->select('id', 'student_id', 'topic','post_image', 'post_video','category_id')->orderBy('id','desc')->get();
    return  json_encode($show);
    
}

//edit posts


public function edit_posts(Request $request){
    $show= Postings::where('id',$request->id)->where('is_deleted',0)->first();
    return  json_encode($show);
}


// save student posts


public function create_student_post(Request $request){
    // If id is 0, it will be an insert, else, it will be an update
    
    $validator = Validator::make($request->all(), [
        'student_id' => 'required|integer',
        'category_id' => 'required',
        'post_name' => 'required',
        // 'post_image' => 'mimes:jpeg,bmp,png,gif,jpg|size:20000',
        // 'post_video' => 'mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv| max:40000'
    ]);   
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
   
   
    if($request->id == 0) {
         $time = date('y-m-d-h-i-s');

    if($request->hasFile('post_image')) {
        $file = $request->file('post_image') ;           
        $post_image = 'postimg_'.$time.'.'.  $file->getClientOriginalExtension();
        $destinationPath = public_path().'/uploads/StudentPostings' ;
        $file->move($destinationPath,$post_image);
    }
    else{
        $post_image='';
    }
    if($request->hasFile('post_video')) {
        $file_video = $request->file('post_video') ;           
        $video = 'video_'.$time.'.'.  $file_video->getClientOriginalExtension();
        $destinationPath = public_path().'/uploads/StudentPostings' ;
        $file_video->move($destinationPath,$video);
    }
    else{
        $video='';
    }
    $postData = new Postings([
        "student_id" => $request->student_id,
        "category_id" => $request->category_id,
        'topic' => $request->post_name,
        'post_image' => $post_image,
        'post_video' => $video,
        'is_active' => 1
    ]);
    
 
    if($postData->save()){
        $post_id =  $postData->id  ;
        
        return response()->json([
            'message' => 'Your post successfully saved!',
            'code' => 201  ,
            'post_id' =>  $post_id 
        ]);
    }else{
        return response()->json([
            'message' => 'Failed to create post!',
            'code' => 400,
            'post_id' => 0
        ]);
    }
}
 else {
      $time = date('y-m-d-h-i-s');

    if($request->hasFile('post_image')) {
        $file = $request->file('post_image') ;           
        $post_image = 'postimg_'.$time.'.'.  $file->getClientOriginalExtension();
        $destinationPath = public_path().'/uploads/StudentPostings' ;
        $file->move($destinationPath,$post_image);
    }
    else{
        $post_image='';
    }
    if($request->hasFile('post_video')) {
        $file_video = $request->file('post_video') ;           
        $video = 'video_'.$time.'.'.  $file_video->getClientOriginalExtension();
        $destinationPath = public_path().'/uploads/StudentPostings' ;
        $file_video->move($destinationPath,$video);
    }
    else{
        $video='';
    }
        Postings::where('id', '=',  $request->id)->update([
                 "student_id" => $request->student_id,
        "category_id" => $request->category_id,
        'topic' => $request->post_name,
        'post_image' => $post_image,
        'post_video' => $video,
        
            ]);
            
        return response()->json([
                'message' => 'Updated!',
                'code' => 201  ,
                'post_id' =>  $request->id
            ]);
    }
    
    
    
}
    
    /*
    Create a student while creating a parent
    */
    public function create_parent_student(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_name' => 'required',
            'contact_number' => 'required|unique:parent_details,contact_no|digits:10'
        ]);

       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       
        $user = new Parentdetail([
            'first_name' => $request->parent_name,
            'contact_no' => $request->contact_number,
            'email' => $request->email,
            'is_Active' => 1
        ]);
        if($user->save()){
            
            $check =  Vendors::where('phone',$request->contact_number)->first();
            if(isset($check->phone) && ($check->phone != ''))
            {
                $vendor_id = $check->id;
                // update vendor id in parent table
                $affectedRows = Parentdetail::where('id', '=', $user->id)->update([
                    'vendor_id'          =>  $vendor_id,
                ]);
            }else{
                $vendor_id =0;
            }
            
            
            $studentData = new Studentdetails([
                "parent_id" => $user->id,
                'first_name' => $request->parent_name,
                'is_active' => 1,
                
            ]);
            
            if($studentData->save()){
                $student_id =  $studentData->id;
                
                
                
                $studentCode = str_pad( $student_id, 4, '0', STR_PAD_LEFT);
                $code = 'MY-EDPT'.date("Y"). $studentCode;
                $affectedRows = Studentdetails::where('id', '=',  $student_id)->update([
                    'student_code'   => $code
                ]);
                return response()->json([
                    'message' => 'Successfully created!',
                    'code' => 201,
                    'parent_id' =>  $user->id,
                    'student_id' =>  $student_id,
                    'parent_name' =>  $code,
                    'student_code' => $code,
                    'vendor_id' => $vendor_id
                ]);
            }else{
                return response()->json([
                    'message' => 'Failed to create student!',
                    'code' => 400,
                    'student_id' => 0,
                    'student_code' => '0'
                ]);
            }
            
        }
        else {
            return response()->json([
                'message' => 'Failed to create parent!',
                'code' => 400
            ]);
        }
        
    }
    
    
    /*
    As per customer, student have two sections. "My" and "My Favourite". Defining two funvtions here
    */
    
    public function update_student_my(Request $request){

        $validator = Validator::make($request->all(), [
            'parent_id' => 'required|integer',
            'first_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $student_id = $request->id;
        $first_name = $request->first_name;
        $pet_name = $request->pet_name;
        $dob = $request->dob;
        $best_friend = $request->best_friend;
        $my_hero = $request->my_hero;
        
        Studentdetails::where('id', '=',  $student_id)->update([
            'first_name' => $first_name,
            'pet_name' => $pet_name,
            'dob' => $dob,
            'best_friend' => $best_friend,
            'my_hero' => $my_hero
        ]);
        
        return response()->json([
            'message' => 'Successfully updated student!',
            'code' => 201,
            'student_code' => '',
            'student_id' =>  $student_id
        ]);
        
    }
    
    public function update_student_my_favourite(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $student_id = $request->id;
        $color = $request->color;
        $subject = $request->subject;
        $food = $request->food;
        $teacher = $request->teacher;
        $hobby = $request->hobby;
        $passtime = $request->passtime;
        
        Studentdetails::where('id', '=',  $student_id)->update([
            'color' => $color,
            'subject' => $subject,
            'food' => $food,
            'teacher' => $teacher,
            'hobby' => $hobby,
            'passtime' => $passtime
        ]);
        
        return response()->json([
            'message' => 'Successfully updated student!',
            'code' => 201,
            'student_code' => '',
            'student_id' =>  $student_id
        ]);
        
    }
    
    
    public function state_list(Request $request){

        /*
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        */
        
        $show = States::where(['is_active' => 1])->select('id', 'state_name','country_id')->orderBy('state_name','asc')->get();
        return  json_encode($show);
    }
    
    public function city_list(Request $request){

        /*
        $validator = Validator::make($request->all(), [
            'state_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        */
        
        
        $show = City::where(['is_active' => 1])->select('id', 'city_name','district_id','country_id','state_id')->orderBy('city_name','asc')->get();
        return  json_encode($show);
    }
    public function district_list(Request $request){
        $show = District::where(['is_active' => 1])->select('id', 'district_name','country_id','state_id')->orderBy('district_name','asc')->get();
        return  json_encode($show);
    }
    public function country_list(Request $request){
        $show = Country::where(['is_active' => 1])->select('id', 'country_name')->orderBy('country_name','asc')->get();
        return  json_encode($show);
    }
    public function edit_my_diary(Request $request){
        $data =  Mydiary::where('id',$request->id)->where('is_deleted',0)->first();
        return  json_encode($data);
    }
    public function save_my_diary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'my_day' => 'required'
        ]);

       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       

        if($request->id == 0) {
            $user = new Mydiary([
                'student_id' => $request->student_id,
                'my_day' => $request->my_day,
                'my_notes' => $request->my_notes,
                'is_active' => 1
            ]);
            if($user->save()){
                return response()->json([
                    'message' => 'Successfully saved note!',
                    'code' => 201  ,
                    'parent_id' => $user->id         
                ]);
            }
            else {
                return response()->json([
                    'message' => 'Failed to create note!',
                    'code' => 400
                ]);
            }
        }
        else {
            Mydiary::where('id', '=',  $request->id)->update([
                'my_day' => $request->my_day,
                'my_notes' => $request->my_notes
            ]);
            
            return response()->json([
                'message' => 'Successfully updated Diary!',
                'code' => 201,
                'parent_id' =>  $request->id
            ]);
        }
        
        
    }
    
    public function get_my_diary(Request $request){

        $show = Mydiary::where(['student_id'=>$request->student_id,'is_active' => 1])->select('id', 'my_day','my_notes', 'created_at')->orderBy('id','desc')->get();
        return  json_encode($show);
    }
    
    public function get_parent_folder(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'student_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $show = Myfolderstructure::where(['is_active' => 1, 'parent_id' => null, 'student_id' => $request->student_id])->select('id', 'student_id', 'my_folder_name', 'parent_id', 'created_at')->orderBy('my_folder_name','asc')->get();
        
        return  json_encode($show);
    }
    
    public function get_child_folders(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'parent_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $show = Myfolderstructure::where(['is_active' => 1, 'parent_id' => $request->parent_id, 'student_id' => $request->student_id])->select('id', 'student_id', 'my_folder_name', 'parent_id', 'created_at')->orderBy('my_folder_name','asc')->get();
        
        return  json_encode($show);
    }
    
    public function save_repository(Request $request) { 
        if ($request->hasFile('file')){
            $image = $request->file('file');
            $time = date('y-m-d-h-i-s');
            // $name = $image->getClientOriginalName();  
            $name = "reposiory".$time;                  
            $destinationPath = public_path('/images/student/repository');
            $image->move($destinationPath, $name);
            
            $user = new Myfiles([
                'student_id' => $request->student_id,
                'my_file_name' => $name,
                'display_name' =>$request->display_name,
                'file_size' => $request->file_size,
                'is_active' => 1
            ]);
            if($user->save()){
                return response()->json([
                    'message' => 'Successfully uploaded file!',
                    'code' => 201
                ]);
            }
            else {
                return response()->json([
                    'message' => 'Failed to upload!',
                    'code' => 400
                ]);
            }
            
            
        }
        else {
            return response()->json([
                'message' => 'Failed to upload!',
                'code' => 400
            ]);
        }
    }
    
    
    public function get_uploaded_files(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'student_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $show = Myfiles::where(['is_active' => 1, 'student_id' => $request->student_id])->select('id', 'student_id', 'my_file_name', 'display_name', 'file_size', 'created_at')->orderBy('id','desc')->get();
        
        return  json_encode($show);
    }
	
	 //get parent details by id

    public function get_parent_details(Request $request){
        $show= Parentdetail::leftJoin( 'countries', 'parent_details.country', '=', 'countries.id')
       ->leftJoin('states', 'parent_details.state', '=', 'states.id')
       ->leftJoin('cities', 'parent_details.city', '=', 'cities.id')
       ->leftJoin('districts', 'parent_details.district', '=', 'districts.id')
       
       ->select('parent_details.*','countries.country_name','states.state_name','districts.district_name','cities.city_name')
      
        ->where('parent_details.id',$request->id)->where('parent_details.is_deleted', 0)
      ->first();
        return  json_encode($show);
    }
    
    //edit parent details


	public function edit_parent_details(Request $request){
        $show= Parentdetail::where(['id'=>$request->id,'is_deleted'=>0])->first();
        return  json_encode($show);
    }

    //update parent details


     public function save_parent_details(Request $request) {
      $validator = Validator::make($request->all(), [
        
	   'first_name'                    => 'required',
            
            'last_name'                  =>'required',
            
            'address'                    => 'required',
            'district'                   => 'required',
            'city'                       => 'required',
            'state'                      => 'required',
            'country'                    => 'required',
           
             'spouse_name'               => 'required',
		
    ]);
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    
    $parent_id = $request->id;
	if($parent_id!=0){
    $affectedRows = Parentdetail::where('id', '=', $parent_id)->update([
         'first_name'                 => $request->first_name,
           'middle_name'                => $request->middle_name,
           'last_name'                  => $request->last_name,
           'dob'                        => $request->dob,
           'address'                    => $request->address,
           'district'                   => $request->district,
           'city'                       => $request->city,
           'state'                      => $request->state,
           'country'                    => $request->country,
           'address_office'             => $request->address_office,
            'qualification'             => $request->qualification,
            'occupation'                => $request->occupation,
            'employment_type'           => $request->employment_type,
            'annual_income'             => $request->annual_income,
            'spouse_name'               => $request->spouse_name,
            'spouse_dob'                => $request->spouse_dob,
            'spouse_employment_type'    => $request->spouse_employment_type,
            'spouse_address_office'     => $request->spouse_address_office,
            'spouse_qualification'      => $request->spouse_qualification,
            'spouse_occupation'         => $request->spouse_occupation,
            'spouse_annual_income'      => $request->spouse_annual_income
          
   ]);
   
   return response()->json([
                    'message' => 'Successfully updated parent details!',
                    'code' => 201    
                ]);
    }
  }

    
    
    public function edit_audio_file(Request $request){
        $show= Audiofiles::where('id',$request->id)->where('is_deleted',0)->first();
        return  json_encode($show);
    }
    
    public function save_audio_file(Request $request){
        // If id is 0, it will be an insert, else, it will be an update
        
        $validator = Validator::make($request->all(), [
            
    			'audio_title' => 'required',
                'audio_file_name' => 'required',
            
        ]);   
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
   
   
        if($request->id == 0) {
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
        		$audio_size=$file_audio->getSize();		
                $audio_file_name = 'audio_'.$time.'.'.  $file_audio->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Audiofiles' ;
                $file_audio->move($destinationPath,$audio_file_name);
            }
            else{
                $audio_file_name='';
            }
            
            $audioData = new Audiofiles([
                'audio_title'		 => $request->audio_title,
                'audio_description' => $request->audio_description,
        		'audio_length' 		=> $audio_size,
                'poster_image_file' => $poster_image_file,
                'audio_file_name' 	=> $audio_file_name,
                'is_active' 		=> 1
            ]);
    
 
            if($audioData->save()){
                $audio_id =  $audioData->id  ;
                
                return response()->json([
                    'message' => 'Audio successfully Uploaded!',
                    'code' => 201  ,
                    'audio_id' =>  $audio_id 
                ]);
            }else{
                return response()->json([
                    'message' => 'Failed to Upload Audio!',
                    'code' => 400,
                    'audio_id' => 0
                ]);
            }
        }
        else {
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
        		$audio_size=$file_audio->getSize();
                $audio_file_name = 'audio_'.$time.'.'.  $file_audio->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/Audiofiles' ;
                $file_audio->move($destinationPath,$audio_file_name);
            }
            else{
                $audio_file_name=$request->old_audio_file_name;
            }
            
            Audiofiles::where('id', '=',  $request->id)->update([
                'audio_file_name' => $audio_file_name,
				'audio_length' 		=> $audio_size,
                "audio_title" => $request->audio_title,
                'audio_description' => $request->audio_description,
                'poster_image_file' => $poster_image_file,
            ]);
            
            return response()->json([
                'message' => 'Updated!',
                'code' => 201  ,
                'audio_id' =>  $request->id
            ]);
        }
    }
    
    public function save_audio_listen_history(Request $request){
        
        Audiolistenhistory::where(['audio_file_id'=>$request->audio_file_id, 'student_id'=>$request->student_id, 'is_deleted'=>0])->delete();
        
        $listenHistory = new Audiolistenhistory([
            'audio_file_id' => $request->audio_file_id,
            'student_id' => $request->student_id,
            'is_Active' => 1
        ]);
        if($listenHistory->save()){
            return response()->json([
                'message' => 'Successfully created history!',
                'code' => 201  ,
                'history_id' => $listenHistory->id         
            ]);
        }
        else {
            return response()->json([
                'message' => 'Failed to create parent!',
                'code' => 400
            ]);
        }
        
    }
    
    public function get_audio_files(Request $request) {
        $show = DB::table('audio_files')
            ->leftJoin('audio_listen_history', 'audio_files.id', '=', 'audio_listen_history.audio_file_id')
            ->select('audio_files.id', 'audio_files.audio_file_name', 'audio_files.audio_length', 'audio_files.audio_title', 'audio_files.audio_description', 'audio_files.poster_image_file', 'audio_files.created_at', 'audio_listen_history.created_at', 'audio_listen_history.audio_file_id')
            ->get();
            
            return  json_encode($show); 
    }
    
    public function get_all_watched_audio_list(Request $request){
        $show = DB::table('audio_files')
            ->join('audio_listen_history', 'audio_files.id', '=', 'audio_listen_history.audio_file_id')
            ->select('audio_files.id', 'audio_files.audio_file_name', 'audio_files.audio_length', 'audio_files.audio_title', 'audio_files.audio_description', 'audio_files.poster_image_file', 'audio_files.created_at', 'audio_listen_history.created_at', 'audio_listen_history.audio_file_id')
            ->where('audio_listen_history.student_id',$request->student_id)
            ->get();
            
            return  json_encode($show); 
    }
 
    public function edit_video_files(Request $request){
        $show= Videofiles::where('id',$request->id)->where('is_deleted',0)->first();
        return  json_encode($show);
    }
    
    
    // save audio files
    
    
    public function save_video_files(Request $request){
        // If id is 0, it will be an insert, else, it will be an update
        
        $validator = Validator::make($request->all(), [
            
    			 'video_title' => 'required',
                'video_file_name' => 'required',
    			 'category_id'       => 'required',
                'age_group_id'       => 'required',
        ]);   
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       
       
        if($request->id == 0) {
             $time = date('y-m-d-h-i-s');
    
        if($request->hasFile('poster_image_file')) {
            $file = $request->file('poster_image_file') ;           
            $poster_image_file = 'posterimg_'.$time.'.'.  $file->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/Videofiles' ;
            $file->move($destinationPath,$poster_image_file);
        }
        else{
            $poster_image_file='';
        }
        if($request->hasFile('video_file_name')) {
            $file_video = $request->file('video_file_name') ; 
    		$video_length=$file_video->getSize();		
            $video_file_name = 'video_'.$time.'.'.  $file_video->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/Videofiles' ;
            $file_video->move($destinationPath,$video_file_name);
        }
        else{
            $video_file_name='';
        }
        $videoData = new Videofiles([
           
            'video_title'		 => $request->video_title,
            'video_description' => $request->video_description,
    		'video_length' 		=> $video_length,
            'poster_image_file' => $poster_image_file,
            'video_file_name' 	=> $video_file_name,
    		'category_id'		=>$request->category_id,
    		'age_group_id'		=>$request->age_group_id,
            'is_active' 		=> 1
        ]);
        
     
        if($videoData->save()){
            $video_id =  $videoData->id  ;
            
            return response()->json([
                'message' => 'Video successfully Uploaded!',
                'code' => 201  ,
                'video_id' =>  $video_id 
            ]);
        }else{
            return response()->json([
                'message' => 'Failed to Upload Video!',
                'code' => 400,
                'video_id' => 0
            ]);
        }
    }
     else {
          $time = date('y-m-d-h-i-s');
    
        if($request->hasFile('poster_image_file')) {
            $file = $request->file('poster_image_file') ;           
            $poster_image_file = 'posterimg_'.$time.'.'.  $file->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/Videofiles' ;
            $file->move($destinationPath,$poster_image_file);
        }
        else{
            $poster_image_file=$request->old_poster_image_file;
        }
        if($request->hasFile('video_file_name')) {
            $file_video = $request->file('video_file_name');
    		$video_length=$file_video->getSize();
            $video_file_name = 'video_'.$time.'.'.  $file_video->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/Videofiles' ;
            $file_video->move($destinationPath,$video_file_name);
        }
        else{
            $video_file_name=$request->old_video_file_name;
        }
            Videofiles::where('id', '=',  $request->id)->update([
                    'video_file_name' 	=>$video_file_name,
    				'video_length' 		=>$video_length,
    				'video_title' 		=>$request->video_title,
    				'video_description' =>$request->video_description,
    				'poster_image_file' =>$poster_image_file,
    				'category_id'		=>$request->category_id,
    				'age_group_id'		=>$request->age_group_id
            
            
                ]);
                
            return response()->json([
                    'message' => 'Updated!',
                    'code' => 201  ,
                    'video_id' =>  $request->id
                ]);
        }
        
        
        
    }
    
    /*
    public function get_video_files(Request $request) {
        $show = Videofiles::where(['is_active' => 1])->select('id', 'video_file_name', 'video_length', 'video_title', 'category_id','age_group_id','video_description', 'poster_image_file', 'created_at')->orderBy('id','desc')->get();
        
        return  json_encode($show);
		
    }
    */
    public function get_videos(Request $request) {
        $show = Videofiles::where(['is_active' => 1])->select('id', 'video_file_name', 'video_length', 'video_title', 'category_id','age_group_id','video_description', 'poster_image_file', 'created_at')->orderBy('id','desc')->get();
        
        return  json_encode($show);
		
    }
    
    /*
    public function get_video_files(Request $request) {
        $show = DB::table('video_files')
            ->leftJoin('video_watched_history', 'video_files.id', '=', 'video_watched_history.video_file_id', 'video_watched_history.student_id', '=', $request->student_id)
            ->leftJoin('ld_category', 'video_files.category_id', '=', 'ld_category.id')
            ->leftJoin('agegroup', 'video_files.age_group_id', '=', 'agegroup.id')
            ->select('video_files.id', 'video_files.video_file_name', 'video_files.video_length', 'video_files.video_title', 'video_files.category_id','video_files.age_group_id','video_files.video_description', 'video_files.poster_image_file', 'video_files.created_at', 'video_watched_history.student_id', 'ld_category.category', 'agegroup.age_group')
            
            ->get();
            
            return  json_encode($show); 
		
    }
    */
    
    public function get_video_files(Request $request) {
        $show = DB::table('video_files')
            ->Join('ld_category', 'video_files.category_id', '=', 'ld_category.id')
            ->Join('agegroup', 'video_files.age_group_id', '=', 'agegroup.id')
            ->select('video_files.id', 'video_files.video_file_name', 'video_files.video_length', 'video_files.video_title', 'video_files.category_id','video_files.age_group_id','video_files.video_description', 'video_files.poster_image_file', 'video_files.created_at', 'ld_category.category', 'agegroup.age_group')
            
            ->get();
            
            return  json_encode($show); 
		
    }
    
    
    public function get_video_watched_history(Request $request) {
        $show = DB::table('video_files')
            ->Join('video_watched_history', 'video_files.id', '=', 'video_watched_history.video_file_id')
            ->Join('ld_category', 'video_files.category_id', '=', 'ld_category.id')
            ->Join('agegroup', 'video_files.age_group_id', '=', 'agegroup.id')
            ->select('video_files.id', 'video_files.video_file_name', 'video_files.video_length', 'video_files.video_title', 'video_files.category_id','video_files.age_group_id','video_files.video_description', 'video_files.poster_image_file', 'video_files.created_at', 'video_watched_history.student_id', 'ld_category.category', 'agegroup.age_group')
            ->where('video_watched_history.student_id',$request->student_id)
            ->get();
            
            return  json_encode($show); 
		
    }
    
    public function save_video_watched_history(Request $request){
        
        Videowatchedhistory::where(['video_file_id'=>$request->video_file_id, 'student_id'=>$request->student_id, 'is_deleted'=>0])->delete();
        
        $listenHistory = new Videowatchedhistory([
            'video_file_id' => $request->video_file_id,
            'student_id' => $request->student_id,
            'is_active' => 1
        ]);
        if($listenHistory->save()){
            return response()->json([
                'message' => 'Successfully created history!',
                'code' => 201  ,
                'parent_id' => $listenHistory->id         
            ]);
        }
        else {
            return response()->json([
                'message' => 'Failed to create parent!',
                'code' => 400
            ]);
        }
        
    }
    
    public function edit_studygroup_request(Request $request)
    {
		$data =  Studygrouprequest::where('id',$request->id)->where('is_deleted',0)->first();
        return  json_encode($data);
    }

   // save studygroup request

    public function save_studygroup_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'group_name' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       
        if($request->id == 0) {
            $studygrouprequest = new Studygrouprequest([
                'student_id' => $request->student_id,
                'group_name' => $request->group_name,
                'message' => $request->message,
                'start_date' => $request->start_date,
                
                'is_active' => 1
            ]);
            if($studygrouprequest->save()){
                return response()->json([
                    'message' => 'Successfully saved Study group Request!',
                    'code' => 201  ,
                    'studygroup_request_id' => $studygrouprequest->id         
                ]);
            }
            else {
                return response()->json([
                    'message' => 'Failed to create Study group Request!',
                    'code' => 400
                ]);
            }
        }
        else {
            Studygrouprequest::where('id', '=',  $request->id)->update([
                'message' => $request->message,
                
            ]);
            
            return response()->json([
                'message' => 'Successfully updated Diary!',
                'code' => 201,
                 'studygroup_request_id' =>  $request->id
            ]);
        }
    }

    // List study group
    public function get_studygroup_list(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
		$show =  DB::select("SELECT study_group_hdr.id,study_group_hdr.group_name,study_group_hdr.start_date,study_group_hdr.end_date,study_group_hdr.requested_student_id ,study_group_dtl.student_id,CONCAT(student_details.first_name,student_details.middle_name,student_details.last_name) AS student_name FROM `study_group_hdr` INNER JOIN study_group_dtl on study_group_hdr.id = study_group_dtl.study_group_hdr_id INNER JOIN student_details on study_group_dtl.student_id = student_details.id WHERE study_group_hdr.is_deleted = 0 AND study_group_dtl.is_deleted = 0 AND study_group_hdr.requested_student_id =  $request->student_id ORDER by study_group_hdr.id asc");

return  json_encode($show);

    }
 
    public function get_studygrouprequest_list(Request $request){
        $data = Studygrouprequest::join( 'student_details', 'study_group_request.student_id', '=', 'student_details.id')
                ->select( 'student_details.first_name',
                'student_details.middle_name',
                'student_details.last_name','study_group_request.*')     
                ->where('study_group_request.is_deleted', 0) ->where('study_group_request.student_id',$request->student_id)  ->orderBy('id','desc')
                ->get();
        
        return  json_encode($data);
    
    }
    
    public function get_quiz_list(Request $request) {
        $show = DB::select('select contentCategory.id, contentCategory.name, contentCategory.description, contentCategory.image,
            cCategory.category, aSubject.subject,
            (
                SELECT count(id) from content_category_questions where content_category_hdr_id = contentCategory.id
                ) as totalQuestions
            
            from content_category_hdr contentCategory
            INNER JOIN content_category cCategory
            ON contentCategory.content_category_id = cCategory.id
            INNER JOIN activity_subject aSubject
            ON contentCategory.subject_id = aSubject.id');
            
            return  json_encode($show); 
		
    }
    
    public function get_quiz_details(Request $request) {
        $questionList = Questions::where(['is_active' => 1, 'content_category_hdr_id' => $request->content_category_hdr_id])->select('id', 'content_category_hdr_id', 'question', 'description', 'file', 'question_type', 'is_active', 'created_at')
        ->get();
        
        foreach ($questionList as $key=>$qnsItem){
            $ansList = Answers::where(['is_active' => 1, 'question_id' => $qnsItem->id])->get();
            $qnsItem->ansOptions=$ansList;
        }
        
        return json_encode($questionList);
    }

    public function get_quiz_name(Request $request) {
      $questions =  ContentDetails::where(['is_active' => 1, 'id' => $request->quiz_id])->first();
      return json_encode($questions);
    }
    
    public function make_payment(Request $request) {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
            'transaction_points' => 'required',
            'invoice_no' => 'required',
            'invoice_date' => 'required',
            'paid_amount' => 'required',
            'payment_mode' => 'required',
            'payment_status' => 'required',
            'payment_recieptno' => 'required',
            'transaction_id' => 'required',
            'response_code' => 'required'
        ]);

       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       

        $payment = new Payments([
            'parent_id' => $request->parent_id,
            'invoice_no' => $request->invoice_no,
            'invoice_date' => $request->invoice_date,
            
            'paid_amount' => $request->paid_amount,
            'payment_mode' => $request->payment_mode,
            'payment_status' => $request->payment_status,
            'payment_recieptno' => $request->payment_recieptno,
            'transaction_id' => $request->transaction_id,
            'response_code' => $request->response_code,
            
            'is_Active' => 1
        ]);
        if($payment->save()){
            
            $payment_id = $payment->id;
            
            $pointTransaction = new Pointtransactions([
                'parent_id' => $request->parent_id,
                'transaction_points' => $request->transaction_points,
                'transaction_description' => $request->transaction_description,
                'payment_id' => $payment_id,
                'course_id' => $request->course_id,
                'teacher_on_demand_id' => $request->teacher_on_demand_id,
                'book_id' => $request->book_id,
                'is_active' => 1,
                
            ]);
            
            $pointTransaction->save();
 
            
            return response()->json([
                'message' => 'Successfully made payment!',
                'code' => 201  ,
                'parent_id' => $payment_id
            ]);
        }
        else {
            return response()->json([
                'message' => 'Failed to make payment!',
                'code' => 400
            ]);
        }
    }
    
    public function get_purchased_course_list(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'student_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
         $show = DB::select("SELECT 
                            cm.id, 
                            cm.course_name, 
                            cm.description, 
                            cm.ld_category_id, 
                            cm.age_group_id, 
                            cm.poster_image, 
                            cm.course_price, 
                            cm.is_active,
                            cp.id as student_count,
                            cp.created_at,
                            lCategory.category,
                            agGrp.age_group
                            
                            FROM course_master cm
                            inner join ld_category lCategory
                            on cm.ld_category_id = lCategory.id
                            inner join courses_purchased cp
                            on cp.course_master_id = cm.id
                            inner join agegroup agGrp
                            on cm.age_group_id = agGrp.id
                            where cm.is_active = 1 and cp.is_active=1 and cp.student_id=$request->student_id
                            order by cm.id desc
                            ");
            
            return  json_encode($show); 
        
    }
    
    public function get_course_list(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'student_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
         $show = DB::select("SELECT 
                            cm.id, 
                            cm.course_name, 
                            cm.description, 
                            cm.ld_category_id, 
                            cm.age_group_id, 
                            cm.poster_image, 
                            cm.course_price, 
                            cm.is_active,
                            (select count(cp.id) from courses_purchased cp where is_active = 1 and cp.course_master_id = cm.id and cp.student_id=$request->student_id) as student_count,
                            (select created_at from courses_purchased cp where is_active = 1 and cp.course_master_id = cm.id and cp.student_id=$request->student_id order by created_at desc limit 1) as created_at,
                            lCategory.category,
                            agGrp.age_group
                            
                            FROM course_master cm
                            inner join ld_category lCategory
                            on cm.ld_category_id = lCategory.id
                            inner join agegroup agGrp
                            on cm.age_group_id = agGrp.id
                            where cm.is_active = 1
                            order by cm.id desc
                            ");
            
            return  json_encode($show); 
        
    }
    
    public function get_course_videos(Request $request) {
        $show = Coursedetails::where(['is_active' => 1, 'course_master_id' => $request->course_master_id])->select('id', 'course_master_id', 'course_detail_title', 'detail_description', 'video_content_file')->orderBy('id','desc')->get();
        
        return  json_encode($show);
		
    }
    
    public function purchase_course(Request $request) {
        $validator = Validator::make($request->all(), [
            'course_master_id' => 'required',
            'parent_id' => 'required',
            'student_id' => 'required',
            'course_points' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $coursesPurchased = new Coursespurchased([
                'course_master_id' => $request->course_master_id,
                'parent_id' => $request->parent_id,
                'student_id' => $request->student_id,
                'created_at' => $request->created_at,
                'is_active' => 1,
            ]);
        
        if($coursesPurchased->save()){
            
            $pointTransaction = new Pointtransactions([
                'parent_id' => $request->parent_id,
                'student_id'=> $request->student_id,
                'transaction_points' => $request->course_points * -1,
                'transaction_description' => 'Course Purchased',
                'course_id' => $request->course_master_id,
                'is_active' => 1
                
            ]);
            
            $pointTransaction->save();
            
            return response()->json([
                'message' => 'Successfully purchased!',
                'code' => 201  ,
                'parent_id' => $request->parent_id
            ]);
        }
        else {
            return response()->json([
                'message' => 'Failed to make payment!',
                'code' => 400
            ]);
        }
    }
    
    public function cancel_course_purchase(Request $request) {
        $affectedRows = Coursespurchased::where('course_master_id', '=', $request->course_id)->where('parent_id', '=', $request->parent_id)->update([
        'is_active' => 0
        ]);
        
        /*
        $affectedRows = Pointtransactions::where('course_id', '=', $request->course_id)->where('parent_id', '=', $request->parent_id)->update([
        'is_active' => 0
        ]);
        */
        
        $pointTransaction = new Pointtransactions([
                'parent_id' => $request->parent_id,
                'student_id'=> $request->student_id,
                'transaction_points' => $request->course_points,
                'transaction_description' => 'Course Cancelled',
                'course_id' => $request->course_id,
                'is_cancelled' => 1,
                'is_active' => 1,
                'created_at' => $request->created_at
            ]);
            
            $pointTransaction->save();
        
        return response()->json([
                'message' => 'Successfully cancelled order!',
                'code' => 201  ,
                'parent_id' => $request->parent_id
            ]);
    }
    
    public function get_course_summary_list(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'parent_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
         $show = DB::select("SELECT 'total_points' AS header,
                            SUM(pt.transaction_points) AS totalPoints
                            FROM 
                            point_transactions pt
                            WHERE pt.parent_id=$request->parent_id AND pt.is_active = 1 
                            
                            union
                            
                            SELECT 'total_student_points' AS header,
                            SUM(pt.transaction_points) AS totalPoints
                            FROM 
                            point_transactions pt
                            WHERE pt.student_id=$request->student_id AND pt.is_active = 1 AND is_deleted = 0 and is_cancelled = 0
                            
                            UNION
                            
                            SELECT 'total_purchases' AS header,
                            SUM(pt.transaction_points) AS totalPoints
                            FROM 
                            point_transactions pt
                            WHERE pt.student_id=$request->student_id AND pt.is_active = 1 AND pt.is_cancelled = 0

                            ");
            
            return  json_encode($show); 
        
    }

    public function save_puzzledetails(Request $request) {
        // $validator = Validator::make($request->all(), [
        //     'puzzledata' => 'required'
        //     ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        
       $puzzledata = $request->post("puzzledata");
       $student_id = $request->post("student_id");
        $content_category_hdr_id = $request->post("puzzleid");
       $countpuzzle =  count($puzzledata);
       for($i=0; $i <  $countpuzzle; $i++){
         
        $moniter_action =   new StudentPuzzles([
            'student_id'  =>  $student_id,
            'content_category_hdr_id' => $content_category_hdr_id,
            'content_category_qus_id'   => $puzzledata[$i]["questionid"],
            'content_category_ans_id' =>  $puzzledata[$i]["answerid"]
       ]);
      
       $moniter_action->save();
               
       }
       if($moniter_action->id)
       {
        return response()->json([
            'message' => 'Your test successfully completed!!',
            'code' => 201  ,
            'id' => $moniter_action->id
        ]);
       }else{
        return response()->json([
            'message' => 'Failed',
            'code' => 400  
        ]);
       }
      
    }
    public function get_attempted_puzzles(Request $request){

        $student_id = $request->post("student_id");
         $validator = Validator::make($request->all(), [
            'student_id' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $show= StudentPuzzles::where(['student_id'=>$student_id])->select('content_category_hdr_id')
        ->groupBy('content_category_hdr_id')
        ->get();
        return  json_encode($show);
    }
    public function dashboard_points(Request $request){
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data['openingBalance'] =  DB::select("SELECT sum(`transaction_points`) as opening_balance FROM `point_transactions` WHERE is_active = 1 AND parent_id = $request->parent_id AND date(created_at) < CURDATE()
        ");
        $data['todayspoints'] =  DB::select("SELECT (SUM(abs(`transaction_points`)) - sum(`transaction_points`)) as spent_points,SUM(abs(`transaction_points`)) as earned_points FROM `point_transactions` WHERE is_active = 1 AND parent_id = $request->parent_id AND date(created_at) = CURDATE()
        ");

        // $show = DB::select("SELECT sum(`transaction_points`) as availbale_points , SUM(abs(`transaction_points`)) as earned_points, (SUM(abs(`transaction_points`)) - sum(`transaction_points`)) as spent_points FROM `point_transactions` WHERE is_active = 1
        // AND parent_id = $request->parent_id ");

        return  json_encode($data); 
    }
    public function get_total_points(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $show = DB::select("
                            SELECT sum(abs(transaction_points)) AS totalPoints
                            FROM 
                            point_transactions 
                            WHERE is_active = 1 
                            AND parent_id = $request->parent_id 

                            ");
            
        return  json_encode($show); 
        /*
        $show = DB::select("
                            SELECT sum(transaction_points) AS totalPoints
                            FROM 
                            point_transactions 
                            WHERE is_active = 1  AND is_deleted = 0 and is_cancelled = 0
                            AND parent_id = $request->parent_id 

                            ");
        */
        $show = DB::select("
                            SELECT sum(transaction_points) AS totalPoints
                            FROM 
                            point_transactions 
                            WHERE is_active = 1 
                            AND parent_id = $request->parent_id 

                            ");
            
        return  json_encode($show); 
        
    }
    
    public function get_payment_history(Request $request){

        $student_id = $request->post("parent_id");
         $validator = Validator::make($request->all(), [
            'parent_id' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $show = DB::select("
                select pt.parent_id, pt.transaction_points, pt.transaction_description, pt.created_at, 
                cm.course_name
                from point_transactions pt
                left join course_master cm
                on pt.course_id = cm.id
                where pt.parent_id = $request->parent_id 

                ");
                            
        return  json_encode($show);
    }
    
    
    public function save_father_details(Request $request) {
      $validator = Validator::make($request->all(), [
	    'first_name'                    => 'required',
        'last_name'                  =>'required',
    ]);
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    
    $parent_id = $request->id;
	if($parent_id!=0){
        $affectedRows = Parentdetail::where('id', '=', $parent_id)->update([
        'first_name'                 => $request->first_name,
        'middle_name'                => $request->middle_name,
        'last_name'                  => $request->last_name,
        'dob'                        => $request->dob,
        'occupation'                 => $request->occupation,
        'employment_type'            => $request->employment_type,
        'qualification'              => $request->qualification,
        'annual_income'              => $request->annual_income,
        'address_office'                    => $request->address_office,
    ]);
   
    return response()->json([
                    'message' => 'Successfully updated parent details!',
                    'code' => 201    
                ]);
    }
  }
     public function save_mother_details(Request $request) {
      $validator = Validator::make($request->all(), [
	    'spouse_name'                    => 'required',
        
    ]);
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    
    $parent_id = $request->id;
	if($parent_id!=0){
        $affectedRows = Parentdetail::where('id', '=', $parent_id)->update([
        'spouse_name'                 => $request->spouse_name,
       
        'spouse_dob'                        => $request->spouse_dob,
        'spouse_occupation'                 => $request->spouse_occupation,
        'spouse_employment_type'            => $request->spouse_employment_type,
        'spouse_qualification'              => $request->spouse_qualification,
        'spouse_annual_income'              => $request->spouse_annual_income,
        'spouse_address_office'                    => $request->spouse_address_office,
    ]);
   
    return response()->json([
                    'message' => 'Successfully updated parent details!',
                    'code' => 201    
                ]);
    }
  }
  public function save_address_details(Request $request) {
      $validator = Validator::make($request->all(), [
	    'address'                    => 'required',
        
    ]);
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    
    $parent_id = $request->id;
	if($parent_id!=0){
        $affectedRows = Parentdetail::where('id', '=', $parent_id)->update([
        'address'                 => $request->address,
       
        'country'                        => $request->country,
        'state'                 => $request->state,
        'district'            => $request->district,
        'city'              => $request->city,
        
    ]);
   
    return response()->json([
                    'message' => 'Successfully updated parent details!',
                    'code' => 201    
                ]);
    }
  }
  public function get_task_list(Request $request) {
    $show = DB::select("
        SELECT 
        t.id, t.task_name, t.description, t.age_group_id, ag.age_group, t.image, t.start_date, t.end_date, t.is_active, t.is_deleted, t.created_at,
        (SELECT COUNT(id) FROM student_tasks st WHERE t.id=st.task_id AND st.student_id = $request->student_id) AS completed_status,
        (SELECT created_at FROM student_tasks st WHERE t.id=st.task_id AND st.student_id = $request->student_id ORDER BY id LIMIT 1) AS completed_on
        
        FROM tasks t
        inner join agegroup ag
        on t.age_group_id = ag.id
        WHERE t.is_active = 1 AND t.is_deleted = 0 AND CURRENT_DATE BETWEEN t.start_date AND t.end_date
    ");
                            
    return  json_encode($show);  
  }
  
  public function get_completed_task_list(Request $request) {
    $show = DB::select("
        SELECT 
        t.id, t.task_name, t.description, t.age_group_id, ag.age_group, t.image, t.start_date, t.end_date, t.is_active, t.is_deleted, t.created_at,
        (SELECT COUNT(id) FROM student_tasks st WHERE t.id=st.task_id AND st.student_id = $request->student_id) AS completed_status,
        (SELECT created_at FROM student_tasks st WHERE t.id=st.task_id AND st.student_id = $request->student_id ORDER BY id LIMIT 1) AS completed_on
        
        FROM tasks t
        inner join agegroup ag
        on t.age_group_id = ag.id
        inner join student_tasks sts
        on t.id = sts.task_id
        
        WHERE t.is_active = 1 AND t.is_deleted = 0 AND CURRENT_DATE BETWEEN t.start_date AND t.end_date AND sts.student_id = $request->student_id
    ");
                            
    return  json_encode($show);  
  }
  
  
  public function save_student_task(Request $request) {
      $studentTask = new Studenttask([
            'student_id' => $request->student_id,
            'task_id' => $request->task_id,
            'completed_status' => $request->completed_status,
            'created_at' => $request->created_at,
            'is_active' => 1
        ]);
        
        if($studentTask->save()) {
            return response()->json([
                'message' => 'Successfully updated task!',
                'code' => 201 ,
                'student_task_id' => $studentTask->id
            ]);
        }
  }
  
    public function get_opinion_poll_list(Request $request) {
        /*
        $opinionList = OptionpollQuestions::where(['option_poll_questions.is_active' => 1])
        ->join('option_poll_types', 'option_poll_questions.poll_type_id', '=', 'option_poll_types.id')
        ->select('option_poll_questions.id', 'option_poll_questions.question', 'option_poll_questions.poll_type_id', 'option_poll_questions.is_active', 'option_poll_questions.created_at', 'option_poll_types.type')
        ->get();
        */
        
        $opinionList = DB::select("
            
            SELECT q.id, q.question, ot.type, so.opinion_poll_question_id, so.opinion_poll_answer_id, so.created_at
            FROM 
            option_poll_questions q
            inner join option_poll_types ot
            on q.poll_type_id = ot.id
            left join student_opinions so
            on q.id = so.opinion_poll_question_id and
            so.student_id = $request->student_id
            where q.is_active =1 and q.is_deleted = 0
        ");
        
        foreach ($opinionList as $key=>$qnsItem){
            $optionList = OptionpollAnswers::where(['is_active' => 1, 'question_id' => $qnsItem->id,'is_deleted' => 0])->get();
            $qnsItem->optionList=$optionList;
        }
        
        return json_encode($opinionList);
    }
    
    public function get_opinion_poll_answered_list(Request $request) {
        
        $opinionList = DB::select("
            
            SELECT q.id, q.question, ot.type, so.opinion_poll_question_id, so.opinion_poll_answer_id, so.created_at
            FROM 
            option_poll_questions q
            inner join option_poll_types ot
            on q.poll_type_id = ot.id
            left join student_opinions so
            on q.id = so.opinion_poll_question_id 
            where
            so.student_id = $request->student_id
        ");
        
        foreach ($opinionList as $key=>$qnsItem){
            $optionList = OptionpollAnswers::where(['is_active' => 1, 'question_id' => $qnsItem->id])->get();
            $qnsItem->optionList=$optionList;
        }
        
        return json_encode($opinionList);
    }
    
    public function save_student_opinion(Request $request) {
      $studentOpinion = new Studentopinion([
            'student_id' => $request->student_id,
            'opinion_poll_question_id' => $request->opinion_poll_question_id,
            'opinion_poll_answer_id' => $request->opinion_poll_answer_id,
            'created_at' => $request->created_at,
            'is_active' => 1
        ]);
        
        if($studentOpinion->save()) {
            return response()->json([
                'message' => 'Successfully voted your opinion ',
                'code' => 201 ,
                'id' => $studentOpinion->id
            ]);
        }
  }
  public function get_poll_details(Request $request) {
    $validator = Validator::make($request->all(), [
	    'poll_id' => 'required',
    ]);
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    $optionList = OptionpollQuestions::join('option_poll_answers','option_poll_answers.question_id','=','option_poll_questions.id')->select('option_poll_questions.id','option_poll_questions.question','option_poll_answers.answer','option_poll_answers.id as answer_id')->where(['option_poll_questions.is_active' => 1, 'option_poll_questions.is_deleted' => 0,'option_poll_questions.id' => $request->poll_id,'option_poll_answers.is_active' => 1, 'option_poll_answers.is_deleted' => 0])->get();

    return json_encode($optionList);
  }
  
  
  public function get_magazine_list(){
        $show= Magazine::where(['is_deleted'=>0,'is_active' => 1])->select('id','title','description', 'poster_image', 'pdf_file', 'created_at')->orderBy('id','desc')->get();
        return  json_encode($show);
    }

    public function get_task_details(Request $request){
        $validator = Validator::make($request->all(), [
            'task_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $taskdetails = Task::join('agegroup','agegroup.id','=','tasks.age_group_id')->select('agegroup.age_group','tasks.*')->where(['tasks.is_active' => 1, 'tasks.is_deleted' => 0,'tasks.id' => $request->task_id])->first();
    
        return json_encode($taskdetails);
    }
    
    public function get_student_blogs(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $allblogs = Studentblogs::join('student_details','student_details.id','=','student_blogs.student_id')->select('student_blogs.*','student_details.first_name','student_details.middle_name','student_details.last_name')->where(['student_blogs.is_active'=>1,'student_blogs.is_deleted'=>0,'student_blogs.approval_status'=>1])->where('student_blogs.student_id', '!=',$request->student_id)->get();

        $myblogs = Studentblogs::join('student_details','student_details.id','=','student_blogs.student_id')->select('student_blogs.*','student_details.first_name','student_details.middle_name','student_details.last_name')->where(['student_blogs.is_active'=>1,'student_blogs.is_deleted'=>0,'student_blogs.student_id'=>$request->student_id])->get();
        return json_encode(array("allblogs"=>$allblogs,"myblogs"=>$myblogs ));
    }
    
    /*
    SEPERATING THIS FUNCTION INTO TWO INDIVIDUAL SELECT.
    IN MOBILE APPLICATION, CAN PERFORM LAZY LOAD
    */
    
    public function get_all_student_blogs(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $allblogs = Studentblogs::join('student_details','student_details.id','=','student_blogs.student_id')->select('student_blogs.*','student_details.first_name','student_details.middle_name','student_details.last_name', 'student_details.image' )->where(['student_blogs.is_active'=>1,'student_blogs.is_deleted'=>0,'student_blogs.approval_status'=>1])->orderBy('id','desc')->get();

        return json_encode($allblogs);
    }
    
    public function get_blogs_by_student_id(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $myblogs = Studentblogs::join('student_details','student_details.id','=','student_blogs.student_id')->select('student_blogs.*','student_details.first_name','student_details.middle_name','student_details.last_name', 'student_details.image')->where(['student_blogs.is_active'=>1,'student_blogs.is_deleted'=>0,'student_blogs.student_id'=>$request->student_id])->orderBy('id','desc')->get();
        return json_encode($myblogs);
    }
    
    public function save_blog(Request $request){
 
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'description' => 'required',
            // 'profile_pic' => 'mimes:jpeg,bmp,png,gif,jpg|size:20000',
           
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $time = date('y-m-d-h-i-s');
        
        if($request->hasFile('file')) {
            $file = $request->file('file') ;           
            $post_image = 'img_'.$time.'.'.  $file->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/studentblogs' ;
            $file->move($destinationPath,$post_image);
        }
        else{
            $post_image='';
        }
        
        if(isset($request->blog_title)) {
            $studentblogs = new Studentblogs([
                'student_id' => $request->student_id,
                'blog_title' => $request->blog_title,
                'description' => $request->description,
                'file' => $post_image,
                'created_at' => $request->created_at,
                'is_active' => 1,
                'approval_status' => 0
            ]);
        }
        else {
            $studentblogs = new Studentblogs([
                'student_id' => $request->student_id,
                'description' => $request->description,
                'file' => $post_image,
                'created_at' => $request->created_at,
                'is_active' => 1,
                'approval_status' => 0
            ]);
        }
        
        
        if($studentblogs->save()) {
            return response()->json([
                'message' => 'Successfully created blog ',
                'code' => 201 ,
                'id' => $studentblogs->id
            ]);
        }
    }
    public function activity_search(Request $request){
        
        $where = "";
        if(!empty($request->keyword)){
            $where .= " AND t.task_name like '%".$request->keyword ."%' OR t.description like '%".$request->keyword ."%'";
        }
        if(!empty($request->agegroup)){
            $where .= " AND t.age_group_id = $request->agegroup";
        }
        $taskdetails = DB::select(" SELECT 
        t.id, t.task_name, t.description, t.age_group_id, ag.age_group, t.image, t.start_date, t.end_date, t.is_active, t.is_deleted, t.created_at,
        (SELECT COUNT(id) FROM student_tasks st WHERE t.id=st.task_id AND st.student_id = $request->student_id) AS completed_status,
        (SELECT created_at FROM student_tasks st WHERE t.id=st.task_id AND st.student_id = $request->student_id ORDER BY id LIMIT 1) AS completed_on
        
        FROM tasks t
        inner join agegroup ag
        on t.age_group_id = ag.id
        WHERE t.is_active = 1 AND t.is_deleted = 0 AND CURRENT_DATE BETWEEN t.start_date AND t.end_date".$where);
        
        return json_encode($taskdetails);
    }
    
    public function puzzle_search(Request $request){
        
        $where = "";
        if(!empty($request->keyword)){
            $where .= " AND contentCategory.name like '%".$request->keyword ."%' OR contentCategory.description like '%".$request->keyword ."%' OR aSubject.subject like '%".$request->keyword ."%'";
        }
        if(!empty($request->category)){
            $where .= " AND cCategory.id = $request->category";
        }
        $taskdetails = DB::select("select contentCategory.id, contentCategory.name, contentCategory.description, contentCategory.image,
        cCategory.category, aSubject.subject,
        (
            SELECT count(id) from content_category_questions where content_category_hdr_id = contentCategory.id
            ) as totalQuestions
        
        from content_category_hdr contentCategory
        INNER JOIN content_category cCategory
        ON contentCategory.content_category_id = cCategory.id
        INNER JOIN activity_subject aSubject
        ON contentCategory.subject_id = aSubject.id where contentCategory.is_active = 1 AND contentCategory.is_deleted = 0".$where);
       
         return json_encode($taskdetails);
    }
	
    public function contentcategory(){
        $data = Contentcategory::where(['is_active'=>1,'is_deleted'=>0])->orderBy('id','desc')->get();
        return json_encode($data);
    }
	public function get_vendorcategory_list(Request $request){

        $show = Vendorcategory::where(['is_active'=>1,'is_deleted'=>0])->orderBy('id','desc')->get();
        return  json_encode($show);
    }
	 public function get_vendors_list(Request $request)
    {
		$data = Vendors::join( 'agegroup', 'vendor_details.age_group_id', '=', 'agegroup.id')
        ->join('vendor_category', 'vendor_details.vendor_category_id', '=', 'vendor_category.id')
       ->select('vendor_details.*','vendor_category.category','agegroup.age_group')
       ->where('vendor_details.is_deleted',0)->where('vendor_details.is_active',1)->where('vendor_details.vendor_category_id',$request->vendor_category_id) 
       ->get();
		//$data =  Vendors::where(['vendor_category_id'=>$request->vendor_category_id,'is_active'=>1,'is_deleted'=>0])->orderBy('id','desc')->get();
		
        return  json_encode($data);
    }
	 public function save_student_queries(Request $request) {
      $studentQuery = new Studentqueries([
            'student_id' => $request->student_id,
            'vendor_category_id' => $request->vendor_category_id,
            'question' => $request->question,
            
        ]);
        
        if($studentQuery->save()) {
            return response()->json([
                'message' => 'Successfully added query!',
                'code' => 201 ,
                'student_query_id' => $studentQuery->id
            ]);
        }
  }
  public function get_vendor_results(Request $request){
        
       $where = "";
        if(!empty($request->subject)){
            $where .= " AND subject like '%".$request->subject ."%'";
        }
        if(!empty($request->agegroup)){
            $where .= " AND age_group_id = $request->agegroup";
        }
		if(!empty($request->district)){
            $where .= " AND district = $request->district";
        }
		if(!empty($request->pincode)){
            $where .= " AND pincode = $request->pincode";
        }
        //$vendordetails = DB::select("select * from vendor_details where is_active = 1 AND is_deleted = 0".$where);
       $vendordetails = DB::select("select vendor_category.id,vendor_category.category,agegroup.id,agegroup.age_group,
vendor_details.first_name,vendor_details.last_name,vendor_details.vendor_category_id,vendor_details.experience,vendor_details.qualification,vendor_details.phone,
vendor_details.age_group_id,vendor_details.pincode,vendor_details.subject
 from vendor_details
INNER JOIN vendor_category 
        ON vendor_category.id = vendor_details.vendor_category_id
INNER JOIN agegroup
        ON agegroup.id = vendor_details.age_group_id
 where vendor_details.is_active = 1 AND vendor_details.is_deleted = 0".$where);
         
		 return json_encode($vendordetails);
    }
	
   public function save_teacherondemand_request(Request $request) {
	    $validator = Validator::make($request->all(), [
	    'student_id'                    => 'required',
		'subject'                    => 'required',
		'requested_date'                    => 'required',
		'requested_time'                    => 'required',
		
        
    ]);
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
      $teacherondemandrequest = new TeacherOnDemand([
            'student_id'                 => $request->student_id,
            'subject'                        => $request->subject,
            'class'  						=> $request->classs,
        'question'                        => $request->question,
        'requested_date'                 => $request->requested_date,
		'requested_time'                 => $request->requested_time,
         'is_active'					=>1,
		   
        ]);
        
        if($teacherondemandrequest->save()) {
            return response()->json([
                'message' => 'Successfully submitted Request!',
                'code' => 201 ,
                'teacher_on_demand_id' => $teacherondemandrequest->id
            ]);
        }
  }
   public function get_teacherondemand_requests_list(Request $request)
    {
		
		$data =  TeacherOnDemand::where(['student_id'=>$request->student_id,'is_active'=>1,'is_deleted'=>0])->orderBy('id','desc')->get();
		
		
        return  json_encode($data);
    }
	public function get_teacherondemand_details(Request $request)
    {
		
		/*$data =  TeacherOnDemand::leftJoin( 'teachers', 'teachers.id', '=', 'teacher_on_demand.teacher_id')
        ->leftJoin('student_details','teacher_on_demand.student_id', '=','student_details.id')
        ->select('teacher_on_demand.*','teachers.first_name as fname','teachers.last_name as lname','student_details.first_name','student_details.middle_name','student_details.last_name')
        ->where('teacher_on_demand.id',$request->id)
        ->where('teacher_on_demand.is_deleted',0)->where('teacher_on_demand.is_active',1)
        ->get();*/
		
		$data = DB::select("select teacher_on_demand.id,teacher_on_demand.student_id,teacher_on_demand.subject,teacher_on_demand.question,
		teacher_on_demand.requested_date,teacher_on_demand.requested_time,teacher_on_demand.approval_status,teacher_on_demand.is_active,
		teacher_on_demand.is_deleted,teacher_on_demand.approved_start_date,teacher_on_demand.approved_start_time,
		teachers.first_name,teachers.last_name 
		

 from teacher_on_demand
INNER JOIN student_details
        ON teacher_on_demand.student_id = student_details.id
INNER JOIN teachers
        ON teacher_on_demand.teacher_id= teachers.id
 where teacher_on_demand.id = $request->id AND teacher_on_demand.is_active = 1 AND teacher_on_demand.is_deleted = 0");
		
        return  json_encode($data);
    }
	 public function save_student_goals(Request $request) {
	    $validator = Validator::make($request->all(), [
	    'student_id'                    => 'required',
		'goal_name'                    => 'required',
		'start_date'                    => 'required',
		'start_time'                    => 'required',
		
        
    ]);
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
      $studentgoal = new Studentgoals([
            'student_id'                 => $request->student_id,
            'goal_name'                        => $request->goal_name,
            'description'  						=> $request->description,
        
			'start_date'                 => $request->start_date,
			'start_time'                 => $request->start_time,
			'end_date'                 => $request->end_date,
			'end_time'                 => $request->end_time,
			'is_active'					=>1,
		   
        ]);
        
        if($studentgoal->save()) {
            return response()->json([
                'message' => 'Successfully saved goal!',
                'code' => 201 ,
                'goal_id' => $studentgoal->id
            ]);
        }
  }
  public function get_student_goals(Request $request)
    {
		
		$data =  Studentgoals::where(['student_id'=>$request->student_id,'is_active'=>1,'is_deleted'=>0])->orderBy('id','desc')->get();
		
		
        return  json_encode($data);
    }
	public function get_student_goals_results(Request $request)
    {
		
		
		$where = "";
		
        if(($request->start_date !=null)&&($request->end_date !=null)){
            $where .= " AND start_date >= '".$request->start_date ."'  AND end_date <= '".$request->end_date ."'";
        }
        
        $data = DB::select(" SELECT student_id,id,goal_name,description,start_date,start_time,end_date,end_time,is_Active,is_deleted FROM student_goals
       
        WHERE is_active = 1 AND is_deleted = 0 AND student_id=$request->student_id ".$where);
        
        return json_encode($data);
		
		
    }
	
	
	public function puzzle_resuls(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'content_category_hdr_id' => 'required|integer',
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = DB::select("SELECT
        student_content_category_results.student_id,
        student_content_category_results.content_category_hdr_id,
        student_content_category_results.content_category_qus_id,
        student_content_category_results.content_category_ans_id,
        content_category_hdr.name,
        content_category_questions.question,
        content_category_answers.answer_option,
        content_category_answers.is_correct_answer,
        (SELECT  content_category_answers.answer_option FROM content_category_answers WHERE content_category_answers.question_id =  student_content_category_results.content_category_qus_id AND content_category_answers.is_correct_answer = 1) as correct_answer
    FROM
        `student_content_category_results`
    JOIN content_category_hdr ON student_content_category_results.content_category_hdr_id = content_category_hdr.id
    JOIN content_category_questions ON student_content_category_results.content_category_qus_id = content_category_questions.id
    JOIN content_category_answers ON student_content_category_results.content_category_ans_id = content_category_answers.id
    WHERE
        student_content_category_results.student_id = $request->student_id AND student_content_category_results.content_category_hdr_id = $request->content_category_hdr_id
    ORDER BY
        content_category_questions.id ASC
        ");
        return json_encode($data);
    }
	public function attempted_quiz_results(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = DB::select("SELECT student_content_category_results.student_id,student_content_category_results.content_category_hdr_id, content_category_hdr.name, content_category_hdr.description,
		content_category_hdr.image,
				(
                SELECT count(id) from content_category_questions where content_category_hdr_id = content_category_hdr.id
                )as totalQuestions,


				sum(content_category_answers.is_correct_answer) as mark FROM `student_content_category_results` JOIN content_category_hdr ON student_content_category_results.content_category_hdr_id = content_category_hdr.id JOIN content_category_questions on student_content_category_results.content_category_qus_id = content_category_questions.id JOIN content_category_answers ON student_content_category_results.content_category_ans_id = content_category_answers.id WHERE student_content_category_results.student_id = $request->student_id GROUP BY student_content_category_results.content_category_hdr_id ASC
			");
        return json_encode($data);
    }
	
	public function save_timetable(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
      
        $date_from = strtotime($request->from_date); // Convert date to a UNIX timestamp  
          
        
        $date_to = strtotime($request->to_date); // Convert date to a UNIX timestamp  
              $item_Count =  count($request->from_time); 
                   
        for ($j=$date_from; $j<=$date_to; $j+=86400) {  
            $plandate = date("Y-m-d", $j);  
            $timetable_array = new  Timetable([
                'student_id'  => $request->student_id,
                'plan_date' =>  $plandate,
                'is_active'     => 1
                ]);
                if($timetable_array->save()) {
                    for ($i = 0; $i < $item_Count; $i++) {
                        $timetabledet_array = new  TimetableDetails([
                            'timetable_id'  => $timetable_array->id,
                            'time_from' =>  $request->from_time[$i],
                            'time_to'=>  $request->to_time[$i],
                            'schedule'=>  $request->schecule[$i],
                            'is_active'     => 1,
                       ]);
                       $timetabledet_array->save();
                }
                }
        } 

       if($timetable_array->save()) {
        return response()->json([
            'message' => 'Successfully submitted Request!',
            'code' => 201 
        ]);
    }
}

public function get_timetables(Request $request) {
    $validator = Validator::make($request->all(), [
        'student_id' => 'required|integer'
    ]);   
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    $show= Timetable::join('student_timetable_details','student_timetable_details.timetable_id','=', 'student_timetable.id')->where(['student_timetable.student_id'=>$request->student_id,'student_timetable.is_deleted'=>0,'student_timetable_details.is_deleted'=>0])->select('student_timetable.*', 'student_timetable_details.id as detailid','student_timetable_details.time_from', 'student_timetable_details.time_to','student_timetable_details.schedule', 'student_timetable_details.is_Active')->orderBy('student_timetable.id','desc')->get();
    return  json_encode($show);
    
}

public function delete_timetable(Request $request) {
    $validator = Validator::make($request->all(), [
        'student_id' => 'required|integer'
    ]);   
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    $affectedRows = TimetableDetails::where('id', '=', $request->id)->update([
        'is_deleted'   => 1]);
        if($affectedRows){
            return response()->json([
                'message' => 'Timetable deleted successfully',
                'code' => 201       
            ]);
            }else{
                return response()->json([
                    'message' => 'Failed to delete timetable',
                    'code' => 400
                ]);
            }
}

public function save_vendordata(Request $request){
    $validator = Validator::make($request->all(), [
        'vendor_id' => 'required|integer'
    ]);   
    
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

        $vendor_id = $request->vendor_id;
        $affectedRows = Vendors::where('id', '=', $vendor_id)->update([
            'first_name'          => $request->first_name,
            'last_name'          => $request->last_name,
            'dob'   => $request->dob,
            'email'         => $request->email,
            'address'     => $request->address,
            'gender'     => $request->gender,
            'vendor_category_id'  => $request->vendor_category_id,
            'pincode'   => $request->pincode,
            'qualification'         => $request->qualification,
            'subject'   => $request->subject,
            'experience'   => $request->experience,
            'description'   => $request->remarks,
            'class' => $request->class,
            'skills' => $request->skills,
            'interest_ondemand' => $request->interest_ondemand,
            'interesed_online_teaching' => $request->interesed_online_teaching,
            'website' => $request->website,
            'branch' => $request->branch,
            'is_active'     => $request->status,
            'work_type' => $request->work_type,
            'other_remarks'=> $request->other_remarks,
            'no_of_students'=> $request->no_of_students
       ]);
}

public function edit_vendordata(Request $request){
    $data =  Vendors::where('id',$request->vendor_id)->where('is_deleted',0)->first();
    return  json_encode($data);
}

}