<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\TeacherOnDemand;
use App\Discussionforum;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
   if(Auth::user()->teacher_id == 0){ // admin user
            $data = Discussionforum::where('discussion_forum_hdr.is_deleted',0) ->where('discussion_forum_hdr.is_active',1)
            ->count();
            return view('pages.default',compact('data'));
       
        }else{ // teachers

            return redirect()->route('teacher.home');

           

        }
    }
}
