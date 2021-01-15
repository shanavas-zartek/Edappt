@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Audio Upload</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"> Audio</a></li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>

            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Upload Audio Files </h4>
                  <form method="POST" id="form1" action="{{ route('audiofileupload.store')}}" enctype="multipart/form-data" >
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="audio_id"  />
                    
                    <div class="form-group">
                      <label for="Title">Title<span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->audio_title)) value="{{$edit->audio_title}}" @endif name="audio_title" id="audio_title" placeholder="Title" />
                      @error('audio_title')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Description">Description</label>
                     <textarea name="audio_description" class="form-control" id="audio_description"> @if(isset($edit->audio_description)) {{$edit->audio_description}} @endif</textarea>
                    </div>
                  
                    <div class="form-group">
                      <label for="Video">Upload Audio<span class="mandatory_sign">*</span></label>
                      <br>
                      <input type="hidden" name="old_audio_file_name" @if(isset($edit->audio_file_name)) value="{{$edit->audio_file_name}}" @endif>
                      @if(isset($edit->audio_file_name)) 
                      <audio  controls preload="auto" width="300" height="300" >
                          <source src="{{ url('uploads/Audiofiles/'.$edit->audio_file_name) }}" >
                           
                        </audio>
                      
                        @endif
                      <input type="file" name="audio_file_name" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Audio" name="image2" />
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                              </span>
                            </div>
                            @error('audio_file_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Image">Poster Image Upload</label><br>

                    @if(isset($edit->poster_image_file))
                      <input type="hidden" name="old_poster_image_file" @if(isset($edit->poster_image_file)) value="{{$edit->poster_image_file}}" @endif>
                      
                      
                     
                        <img src="{{ url('uploads/Audiofiles/'.$edit->poster_image_file) }}" height="200px" width="200px">
                      
                    @endif
                      <input type="file" name="poster_image_file" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Poster Image"  />
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                              </span>
                            </div>
               
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
                    <input type="hidden"   value="{{ route('audiofileupload.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
         