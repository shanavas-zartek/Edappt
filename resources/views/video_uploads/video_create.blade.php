@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Video Upload</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"> Video</a></li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>

            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title"> Upload Video Files </h4>
                  <form method="POST" id="form1" action="{{ route('videofileupload.store')}}" enctype="multipart/form-data" >
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="video_id"  />
                    
                    <div class="form-group">
                      <label for="Title">Title<span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->video_title)) value="{{$edit->video_title}}" @endif name="video_title" id="video_title" placeholder="Title" />
                      @error('video_title')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Description">Description</label>
                     <textarea name="video_description" class="form-control" id="video_description"> @if(isset($edit->video_description)) {{$edit->video_description}} @endif</textarea>
                    </div>
                    <div class="form-group">
                      <label for="Category">Category <span class="mandatory_sign">*</span></label>
                      <select name="category_id" class="form-control" >
                      <option value="">--- Select  ---</option>
                     @foreach($category as $row)
                      <option @if((isset($edit->category_id )) && ($edit->category_id == $row->id)) selected @endif value="{{$row->id}}">{{$row->category}}</option>
                     @endforeach
                      </select>
                    

                      @error('category_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Age Group">Age Group<span class="mandatory_sign">*</span></label>
                      <select name="age_group_id" class="form-control" >
                    <option value="">--- Select  ---</option>
                    @foreach ($agegroup as $age)
                    <option @if(isset($edit->age_group_id) && ($edit->age_group_id == $age->id)) selected @endif value="{{ $age->id }}"  >{{ $age->age_group }}</option>
                    @endforeach      
                </select>
                @error('age_group_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Video">Upload Video<span class="mandatory_sign">*</span></label>
                      <br>
                      <input type="hidden" name="old_video_file_name" @if(isset($edit->video_file_name)) value="{{$edit->video_file_name}}" @endif>
                      @if(isset($edit->video_file_name)) 
                      <video width="320" height="240" controls>
                              <source src="{{ url('uploads/Videofiles/'.$edit->video_file_name) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @endif
                      <input type="file" name="video_file_name" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Video" name="image2" />
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                              </span>
                            </div>
                            @error('video_file_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Image">Poster Image Upload</label><br>

                    @if(isset($edit->poster_image_file))
                      <input type="hidden" name="old_poster_image_file" @if(isset($edit->file)) value="{{$edit->file}}" @endif>
                      
                      
                     
                        <img src="{{ url('uploads/Videofiles/'.$edit->poster_image_file) }}" height="200px" width="200px">
                      
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
                    <input type="hidden"   value="{{ route('videofileupload.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
         