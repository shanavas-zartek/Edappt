@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Course Videos</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Course </a></li>
                  <li class="breadcrumb-item active" aria-current="page">  Videos </li>
                </ol>
              </nav>
            </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Video Upload</h4>
                  <form method="POST" id="form1" action="{{ route('coursedetails.store')}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="id"  />
                    <div class="form-group">
                      <label for="Course">Course <span class="mandatory_sign">*</span></label>
                      <select name="course_master_id" class="form-control" >
                      <option value="">Select</option>
                     @foreach($coursemaster as $course)
                      <option @if((isset($edit->course_master_id )) && ($edit->course_master_id == $course->id)) selected @endif value="{{$course->id}}">{{$course->course_name}} </option>
                     @endforeach
                      </select>                    
                      @error('course_master_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="VideoTitle">Video Title <span class="mandatory_sign">*</span></label>
                      <input type="text" name="course_detail_title" class="form-control" id="course_detail_title" @if(isset($edit->course_detail_title))value="{{$edit->course_detail_title}}" @endif placeholder="Video Title" value="{{ old('course_detail_title') }}">
                      @error('course_detail_title')<span class="mandatory_sign">{{ $message }}</span>@enderror 
                    </div>
                    <div class="form-group">
                      <label for="Description">Description</label>
                     <textarea name="detail_description" class="form-control" id="detail_description"> @if(isset($edit->detail_description)) {{$edit->detail_description}} @endif </textarea>
                    </div>
                    <div class="form-group">
                      <label for="Image">Video Upload<span class="mandatory_sign">*</span></label><br>

                    @if(isset($edit->video_content_file))
                      <input type="hidden" name="video_content_file1" @if(isset($edit->video_content_file)) value="{{$edit->video_content_file}}" @endif>
                      <video class="video-js" controls preload="auto" width="300" height="300" data-setup="{}">
                          <source src="{{ url('uploads/Courses/'.$edit->video_content_file) }}" >
                      </video>
                    @endif
                      <input type="file" name="video_content_file" class="file-upload-default" @if(isset($edit->video_content_file)) value="{{$edit->video_content_file}}" @endif/>
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Video"  name="video_content_file" @if(isset($edit->video_content_file)) value="{{$edit->video_content_file}}" @endif />
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                        </span>
                      </div>
                      @error('video_content_file')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Status">Status<span class="mandatory_sign">*</span></label>
                      <select name="status" class="form-control" >
                    <option value="">Select</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 1)) selected @endif value="1"  >Active</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 0)) selected @endif value="0" >Inactive </option>
                </select>
                @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>                    
                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('coursedetails.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script>  
         