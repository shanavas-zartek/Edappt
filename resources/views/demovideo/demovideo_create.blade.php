@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Demo Video</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Demo Video</a></li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>

            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Demo Video </h4>
                  <form method="POST" id="form1" action="{{ route('demo.store')}}" enctype="multipart/form-data" >
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="video_id"  />
                    
                    <div class="form-group">
                      <label for="Title">Title<span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->title)) value="{{$edit->title}}" @endif name="title" id="title" placeholder="Title" />
                      @error('title')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Description">Description</label>
                     <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                    </div>

                    <div class="form-group">
                      <label for="Video">Upload Video<span class="mandatory_sign">*</span></label>
                      <br>
                      <input type="hidden" name="old_demo_video" @if(isset($edit->file)) value="{{$edit->file}}" @endif>
                      @if(isset($edit->file)) 
                      <video width="320" height="240" controls>
                              <source src="{{ url('uploads/demovideos/'.$edit->file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @endif
                      <input type="file" name="demo_video" class="file-upload-default"  @if(isset($edit->file))  value="{{ url('uploads/demovideos/'.$edit->file) }}"  @endif/>
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Video" name="image2" />
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                              </span>
                            </div>
                            @error('demo_video')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                   

                    <div class="form-group">
                      <label for="Status">Status<span class="mandatory_sign">*</span></label>
                        <select name="status" class="form-control" >
                        <option value="">--- Select  ---</option>
                        <option @if(isset($edit->is_active) && ($edit->is_active == 1)) selected @endif value="1"  >Active</option>
                        <option @if(isset($edit->is_active) && ($edit->is_active == 0)) selected @endif value="0" >Inactive </option>
                        </select>
                        @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    
                    
                    
                    
                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('demo.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
         