 @include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student Blogs</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Blogs </a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Student </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-12">
                <div class="card-body">
                  <h4 class="card-title">Blogs</h4>
                  <form method="POST" id="form1" action="{{ route('studentblogs.store')}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="student_blog_id"  />
                    <div class="row">
                      <div class="col-md-6">
                       <div class="form-group">
                      <label for="Student Name">Student Name <span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->first_name)) value="{{$edit->first_name." ".$edit->middle_name." ".$edit->last_name}}" @endif  readonly />
                      @error('blog_title')<span class="mandatory_sign">{{ $message }}</span>@enderror
                      </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                      <label for="Title">Title <span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->blog_title)) value="{{$edit->blog_title}}" @endif  readonly />
                      @error('blog_title')<span class="mandatory_sign">{{ $message }}</span>@enderror
                      </div>
                     </div>
                </div>
                  
                    <div class="row">
                   
                        @if(isset($edit->file))
                        <div class="col-md-6">
                       <div class="form-group">
                      <label for="File">File <span class="mandatory_sign">*</span></label><br>
                      @if(isset($edit->file_type)&&($edit->file_type=='image')) 
                      <img  src="{{ url('uploads/studentblogs/'.$edit->file) }}"  height="150" width="150" >
                      @elseif(isset($edit->file_type)&&($edit->file_type=='video')) 

                        <video  class="video-js" controls preload="auto" width="300" height="300" data-setup="{}">
                            <source src="{{ url('uploads/studentblogs/'.$edit->file) }}" type='video/mp4'>
                        </video>
                    @endif
                     
                      </div>
                     </div>
                     @endif
                     @if(isset($edit->description)) 
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea name="description" class="form-control" id="description"  readonly>  {{$edit->description}} </textarea>
                           
                          </div>
                        </div>
                        @endif
                    </div>
               
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="Published From">Published From <span class="mandatory_sign">*</span></label>
                        <input type="date" name="published_from" class="form-control" @if(isset($edit->published_from)) value="{{$edit->published_from}}" @endif  placeholder="Published From Date" />
                        @error('published_from')<span class="mandatory_sign">{{ $message }}</span>@enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Published To">Published To <span class="mandatory_sign">*</span></label>
                            <input type="date" class="form-control"  name="published_to" id="published_to" placeholder="Published To Date" @if(isset($edit->published_to)) value="{{$edit->published_to}}" @endif />
                            @error('published_to')<span class="mandatory_sign">{{ $message }}</span>@enderror
                          </div>
                        </div>
                     </div>
 
                     
                  <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="Status">Status <span class="mandatory_sign">*</span></label>
                    <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 1)){ selected }@endif value="1">Active</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 0) ){selected} @endif value="0">Inactive</option>
                    </select>
                    @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="Approval Status">Approval Status <span class="mandatory_sign">*</span></label>
                    <select name="approval_status" class="form-control">
                    <option value="">Select</option>
                    <option @if($edit->approval_status == 1)selected  @endif value="1">Approved</option>
                    <option @if($edit->approval_status == 2) selected @endif value="2" >Rejected</option>
                    <option @if($edit->approval_status == 0) selected @endif value="0" >Not Approved</option>
                    </select>
                    @error('approval_status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    </div>
                </div>

                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('studentblogs.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
          