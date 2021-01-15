<?php

namespace App\Http\Controllers;

use App\Loginhistory;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use App\User;
class LoginhistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->isAbleTo('parent_details')){

        $data = Loginhistory::join( 'parent_details', 'login_history.logged_user_id', '=', 'parent_details.id')
        
        ->select('login_history.*','parent_details.*')
       
        ->orderBy('login_history.id','desc')
        ->get();
       return view('parentdetail.loginhistory',compact('data'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loginhistory  $loginhistory
     * @return \Illuminate\Http\Response
     */
    public function show(Loginhistory $loginhistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loginhistory  $loginhistory
     * @return \Illuminate\Http\Response
     */
    public function edit(Loginhistory $loginhistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loginhistory  $loginhistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loginhistory $loginhistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loginhistory  $loginhistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loginhistory $loginhistory)
    {
        //
    }
}
