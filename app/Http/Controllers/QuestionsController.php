<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Questions;
use  App\Answers;
use DB;
use Auth;
use Redirect;
class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questions.questions_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time = date('y-m-d-h-i-s');

        if($request->hasFile('quest_file')) {
            $file = $request->file('quest_file') ;
             $fileName = 'question_'.$time.'.'.            $file->getClientOriginalExtension();

            $destinationPath = public_path().'/uploads/Questions' ;
            $file->move($destinationPath,$fileName);
        }
        else{
            $fileName = '';
        }
  
    $action =   Questions::create([
        'content_category_hdr_id'  => $request->hdr_id,
        'question' => $request->question,
        'description'   => $request->description,
        'file' =>   $fileName ,
        'is_active'     => $request->status,
        'is_deleted'    => 0,
        'created_by'    => Auth::user()->id,
        'updated_by'    =>0,
        'deleted_by'    =>0
   ]);
   $question_id = $action->id;

    $item_Count =  count($request->answer);
//    echo  $request->right_answer[0];die;
    for ($i = 0; $i <= $item_Count; $i++) {
        if (!empty($request->answer[$i])) {	
         $answer =  $request->answer[$i];
            // echo '$i : '.$i;
       if(isset($request->right_answer[$i]))   
       $right_answer = $request->right_answer[$i]; 
       else  $right_answer = 0;
            $answer_array =   Answers::create([
                'question_id'  => $question_id,
                'answer_option' =>  $answer,
                'is_correct_answer'  =>  $right_answer,
                'is_active'     => $request->status,
                'is_deleted'    => 0,
                'created_by'    => Auth::user()->id,
                'updated_by'    =>0,
                'deleted_by'    =>0
           ]);
        }
    } 
    if($action){
         $datas =  $this->show($request->hdr_id);
         return response()->json($datas);
     
     }
    
   
    }
     public function questiondelete(Request $request){
       $qstnid = $request->qstnid;
        
        $hdr_id = $request->hdr_id; 
       $ansdel =  Answers::where('question_id', '=', $qstnid)->update([
            'is_deleted' => 1,
            'deleted_by' => Auth::user()->id,
            'deleted_at'=>date('Y-m-d h:i:s')
        ]);
      $qstndel =  Questions::where('id', '=', $qstnid)->update([
            'is_deleted' => 1,
            'deleted_by' => Auth::user()->id,
            'deleted_at'=>date('Y-m-d h:i:s')
       ]);



      $datas =  $this->show($request->hdr_id);
      return response()->json($datas);
    
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Questions::where('content_category_hdr_id', $id)
        ->join('content_category_answers','content_category_questions.id','content_category_answers.question_id')
        ->where('content_category_questions.is_deleted',0)
        ->where('content_category_answers.is_deleted',0)
        ->where('content_category_answers.is_active',1)
        ->where('content_category_questions.is_active',1)
        ->orderBy('content_category_questions.id','desc')->get();
         return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function createQuestions($id)
    {
        $hdr_id = $id;
        $quesAnsData  = $this->show($id);
        return view('questions.questions_create',compact('hdr_id','quesAnsData'));
    }
  

  
}

