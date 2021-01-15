<?php

namespace App\Http\Controllers;
use App\OptionpollQuestions;
use App\OptionpollAnswers;
use App\Optionpolltype;
use DB;
use Auth;
use Redirect;
use Illuminate\Http\Request;
use App\User;
class OptionpollController extends Controller
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
       $data = OptionpollQuestions::where('option_poll_questions.is_deleted', 0)
       ->join('option_poll_types','option_poll_types.id','option_poll_questions.poll_type_id')
       ->select('option_poll_questions.id','option_poll_questions.question','option_poll_types.type','option_poll_questions.is_active')
       ->orderBy('option_poll_questions.id','desc')
       ->get();
      
        return view('optionpoll.optionpoll_list',compact('data'));
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
        $poll_type = Optionpolltype::where('is_deleted', 0)->get();
        return view('optionpoll.optionpoll_create',compact('poll_type'));
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
    public function store(Request $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
        if(( $request->question_id !="") && ( $request->question_id > 0)){  
            $question_id = $request->question_id;
            $action =  OptionpollQuestions::where('id', '=',  $question_id)->update([
                'question' => $request->question,
                'poll_type_id'   => $request->poll_type,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'updated_by'    => Auth::user()->id,
                'deleted_by'    => 0
           ]);
           OptionpollAnswers::where('question_id', '=',  $question_id)->delete();
           $item_Count =  count($request->answer);
       
           for ($i = 0; $i <= $item_Count; $i++) {
               if (!empty($request->answer[$i])) {	
                $answer =  $request->answer[$i];
   
                   $answer_array =   OptionpollAnswers::create([
                       'question_id'  => $question_id,
                       'answer' =>  $answer,
                       'is_active'     => $request->status,
                       'is_deleted'    => 0,
                       'created_by'    => Auth::user()->id,
                       'updated_by'    =>0,
                       'deleted_by'    =>0
                  ]);
               }
           } 
           if($action){
            return response()->json(['status'=>2,'Message'=>'Option poll updated Successfully']);         
         }else{
            return response()->json(['status'=>2,'Message'=>'Failed to update option poll']);   
         }
        }else{
            $action =  OptionpollQuestions::create([
                'question' => $request->question,
                'poll_type_id'   => $request->poll_type,
                'is_admin' => 1,
                'approval_status'=>1,
                'approved_on' => date('Y-m-d'),
                'approved_by' => Auth::user()->id,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by'    =>0,
                'deleted_by'    =>0
           ]);
           $question_id = $action->id;
        
            $item_Count =  count($request->answer);
       
            for ($i = 0; $i <= $item_Count; $i++) {
                if (!empty($request->answer[$i])) {	
                 $answer =  $request->answer[$i];
    
                    $answer_array =   OptionpollAnswers::create([
                        'question_id'  => $question_id,
                        'answer' =>  $answer,
                        'is_active'     => $request->status,
                        'is_deleted'    => 0,
                        'created_by'    => Auth::user()->id,
                        'updated_by'    =>0,
                        'deleted_by'    =>0
                   ]);
                }
            } 
            if($action){
                return response()->json(['status'=>1,'Message'=>'Option poll created Successfully']);         
             }else{
                return response()->json(['status'=>1,'Message'=>'Failed to create option poll']);   
             }
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
        if($user->isAbleTo('option_polls')){
        $poll_type = Optionpolltype::where('is_deleted', 0)->get();
        $edit = OptionpollQuestions::join('option_poll_answers','option_poll_answers.question_id','option_poll_questions.id')
        ->join('option_poll_types','option_poll_types.id','option_poll_questions.poll_type_id')
        ->select('option_poll_questions.id','option_poll_questions.question','option_poll_types.type','option_poll_questions.poll_type_id','option_poll_questions.is_active')
        ->where('option_poll_questions.is_deleted', 0)
        ->where('option_poll_questions.id', $id)
        ->orderBy('option_poll_questions.id','desc')
        ->first();
        $option_answers = OptionpollAnswers::where('is_deleted',0)->where('question_id',$id)->get();
     
        return view('optionpoll.optionpoll_edit',compact('poll_type','edit','option_answers'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

    
    public function approval($id)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
        $poll_type = Optionpolltype::where('is_deleted', 0)->get();
        $edit = OptionpollQuestions::join('option_poll_answers','option_poll_answers.question_id','option_poll_questions.id')
        ->join('option_poll_types','option_poll_types.id','option_poll_questions.poll_type_id')
        ->select('option_poll_questions.id','option_poll_questions.question','option_poll_types.type','option_poll_questions.poll_type_id','option_poll_questions.is_active')
        ->where('option_poll_questions.is_deleted', 0)
        ->where('option_poll_questions.id', $id)
        ->orderBy('option_poll_questions.id','desc')
        ->first();
        $option_answers = OptionpollAnswers::where('is_deleted',0)->where('question_id',$id)->get();
     
        return view('optionpoll.optionpoll_approval',compact('poll_type','edit','option_answers'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
  
    public function delete($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
        OptionpollQuestions::where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        OptionpollAnswers::where('question_id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('optionpoll')
        ->with('alert-success','Option poll deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    // delete requested polls
    public function delete_request($id){
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
        OptionpollQuestions::where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        OptionpollAnswers::where('question_id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('optionpoll.requests')
        ->with('alert-success','Option poll deleted successfully.');
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    public function requests()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
        $data = OptionpollQuestions::where('option_poll_questions.is_deleted', 0)
        ->where('option_poll_questions.is_admin',0)
        ->where('option_poll_questions.approval_status',0)
       ->join('option_poll_types','option_poll_types.id','option_poll_questions.poll_type_id')
       ->select('option_poll_questions.id','option_poll_questions.question','option_poll_types.type','option_poll_questions.is_active')
       ->orderBy('option_poll_questions.id','desc')
       ->get();
        return view('optionpoll.optionpoll_requests',compact('data'));
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }
    public function approve_requests(Request $request){
        $user = User::find(Auth::id());
        if($user->isAbleTo('option_polls')){
        if(isset($request->question_id) && $request->question_id !="") {
            $id =$request->question_id;
          $affectedRows = OptionpollQuestions::where('id', '=', $id)->update([
              'approval_status'  => $request->approval_status,
              'approved_on'   => date('Y-m-d'),
              'is_active'     => $request->status,
              'is_deleted'     => 0,
              'updated_by'     => Auth::user()->id,
              'deleted_by' =>0
         ]);
         $request->session()->flash('alert-success', 'Option poll updated successfully');
         return Redirect::to('optionpoll.requests');
        }else{
          $request->session()->flash('alert-danger', 'Failed to update option poll');
          return Redirect::to('optionpoll.requests');
        }
    }else{
        abort(403,"You don't have permission to access this page");
    }
    }

}
