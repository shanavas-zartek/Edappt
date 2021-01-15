<?php

namespace App\Http\Controllers;

use App\Magazine;
use Illuminate\Http\Request;
use App\Http\Requests\Magazine\StoreMagazineRequest;
use DB;
use Auth;
use Redirect;
use App\User;

class MagazineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Magazine::where('is_deleted', 0) ->orderBy('id','desc')->get();
        return view('magazine.magazinelist',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('magazine.magazinecreate');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMagazineRequest $request)
    {        
        if(($request->id !="") && ($request->id > 0)){   //update
            $id= $request->id;
            $time = date('y-m-d-h-i-s');

            if($request->hasFile('poster_image')) {
                $poster_image = $request->file('poster_image') ;            
                $imagefileName = 'poster_'.$time.'.'.           $poster_image->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Magazine/' ;
                $poster_image->move($destinationPath,$imagefileName);
            }
            else{
                $imagefileName=$request->poster_image1;
            }

            if($request->hasFile('pdf_file')) {
                $pdf_file = $request->file('pdf_file') ;
                $pdffilename = 'magazine_'.$time.'.'.           $pdf_file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Magazine' ;
                $pdf_file->move($destinationPath,$pdffilename);
            }
            else{
                $pdffilename=$request->pdf_file1;
            }

                $affectedRows = Magazine::where('id', '=', $id)->update([
                'title' => ucfirst($request->title),
                'description'   => $request->description,
                'poster_image'  => $imagefileName,
                'pdf_file'      => $pdffilename,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'updated_by'     => Auth::user()->id,
                'deleted_by'     => 0,               
           ]);
                    
           $request->session()->flash('alert-success', 'Magazine updated successfully');       
           return Redirect::to('magazine');

        }else{
            $time = date('y-m-d-h-i-s');
            if($request->hasFile('poster_image')) {
                $poster_image = $request->file('poster_image') ;            
                $imagefileName = 'poster_'.$time.'.'.           $poster_image->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Magazine/' ;
                $poster_image->move($destinationPath,$imagefileName);
            }
            else{
                $imagefileName=$request->poster_image1;
            }

            if($request->hasFile('pdf_file')) {
                $pdf_file = $request->file('pdf_file') ;
                $pdffilename = 'magazine_'.$time.'.'.           $pdf_file->getClientOriginalExtension() ;
                $destinationPath = public_path().'/uploads/Magazine' ;
                $pdf_file->move($destinationPath,$pdffilename);
            }
            else{
                $pdffilename=$request->pdf_file1;
            }
            $moniter_action =   Magazine::create([
           
                'title' => $request->title,
                'description'   => $request->description,                
                'poster_image'   => $imagefileName,
                'pdf_file' =>  $pdffilename,
                'is_active'     =>$request->status,
                'is_deleted'     => 0,
                'created_by'     => Auth::user()->id,
                'updated_by' => 0,
                'deleted_by' => 0,
           ]);
           
         
           $request->session()->flash('alert-success', 'Magazine created successfully');       
           return Redirect::to('magazine');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $edit =  Magazine::where('id',$id)->first();
        return view('magazine.magazinecreate',compact('edit'));
    }

    /***Delete magazine***/
    public function delete($id){
        DB::table('magazine')
        ->where('id', $id)
        ->update(array('is_deleted' => 1,'deleted_by' => Auth::user()->id,'deleted_at'=>date('Y-m-d h:i:s')));
        return Redirect::to('magazine')
        ->with('alert-success','Magazine deleted successfully.');
    }   
}
