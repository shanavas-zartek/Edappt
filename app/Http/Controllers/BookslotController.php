<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Redirect;
use App\Bookslot;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Bookslot\StoreBookslotRequest;

class BookslotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('book_slot')){
        $data = Bookslot::where('bookslot.is_deleted', 0)
        ->join('student_details','bookslot.student_id','student_details.id')
        ->select('bookslot.*','student_details.first_name','student_details.middle_name','student_details.last_name')
        ->orderBy('bookslot.id','desc')->get();
        return view('bookslot.bookslot_list',compact('data'));
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
    public function store(StoreBookslotRequest $request)
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('book_slot')){
        if(isset($request->book_slot_id) && $request->book_slot_id !="") {
            $id =$request->book_slot_id;
          $affectedRows = Bookslot::where('id', '=', $id)->update([
              'start_date' => $request->start_date,
              'start_time' => $request->start_time,
              'end_time' => $request->end_time,
              'approval_status'  => $request->approval_status,
              'approved_on'   => date('Y-m-d'),
              'is_active'     => $request->status,
              'is_deleted'     => 0,
              'updated_by'     => Auth::user()->id,
              'deleted_by' =>0
         ]);
         $request->session()->flash('alert-success', 'Booking slot updated successfully');
         return Redirect::to('bookslot');
        }else{
          $request->session()->flash('alert-danger', 'Failed to update Booking slot');
          return Redirect::to('bookslot');
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
        if($user->isAbleTo('book_slot')){

        $data = Bookslot::where('bookslot.is_deleted', 0)
        ->join('student_details','bookslot.student_id','student_details.id')
        ->select('bookslot.*','student_details.first_name','student_details.middle_name','student_details.last_name')
        ->orderBy('bookslot.id','desc')->where('bookslot.id',$id)->first();
        return view('bookslot.bookslot_view',compact('data'));
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

    public function checkslot(Request $request){
        $book_slot_id = $request->book_slot_id;
        $date = $request->start_date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $input_date_starttime = $date.' '.$start_time;
        $input_date_endtime = $date.' '.$end_time;
       
       $datacount =  count(DB::select("SELECT * FROM bookslot WHERE ( (
        '$input_date_starttime' BETWEEN TIMESTAMP (start_date, start_time)
        AND TIMESTAMP (start_date, end_time)) OR (          '$input_date_endtime' BETWEEN TIMESTAMP (start_date, start_time)
        AND TIMESTAMP (start_date, end_time) )) AND id !=  $book_slot_id"));
             
         return response()->json(['count'=>$datacount]);
    }

    
}
