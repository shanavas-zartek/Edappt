 @include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">L&D Details</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Learning & Development </a></li>
                  <li class="breadcrumb-item active" aria-current="page">  L&D Details </li>
                </ol>
              </nav>
            </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">L&D Details
</h4>
                  <form method="POST" id="form1" action="{{ route('development.store')}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="ld_category_id"  />
                    <div class="form-group">
                      <label for="Category">Category <span class="mandatory_sign">*</span></label>
                      <select name="category_id" class="form-control" >
                      <option value="">Select</option>
                     @foreach($category as $row)
                      <option @if((isset($edit->category_id )) && ($edit->category_id == $row->id)) selected @endif value="{{$row->id}}">{{$row->category}}</option>
                     @endforeach
                      </select>
                    

                      @error('category_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Description">Description</label>
                     <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                    </div>
                    <div class="form-group">
                      <label for="Image">Image/Audio/Video Upload<span class="mandatory_sign">*</span></label><br>

                    @if(isset($edit->file))
                      <input type="hidden" name="ld_file1" @if(isset($edit->file)) value="{{$edit->file}}" @endif>
                      <input type="hidden" name="file_type1" @if(isset($edit->file_type)) value="{{$edit->file_type}}" @endif>
                      
                      <?php
                      $filetype=$edit->file_type;
                      $filetypenew=explode("/",$filetype);
                      
                      ?>
                      
                      @if(isset($edit->file_type)&&($filetypenew[0]== 'image')) 
                        <img src="{{ url('uploads/ld/'.$edit->file) }}" height="200px" width="200px">
                      @elseif(isset($edit->file_type)&&($filetypenew[0]=='video')) 
                        <video class="video-js" controls preload="auto" width="300" height="300" data-setup="{}">
                          <source src="{{ url('uploads/ld/'.$edit->file) }}" >
                           
                        </video>
                      @elseif(isset($edit->file_type)&&($filetypenew[0]=='audio')) 
                        <audio  controls preload="auto" width="300" height="300" >
                          <source src="{{ url('uploads/ld/'.$edit->file) }}" >
                           
                        </audio>
                      @endif
                    @endif
                      <input type="file" name="ld_file" class="file-upload-default" @if(isset($edit->file)) value="{{$edit->file}}" @endif/>
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image/Audio/Video"  name="ld_file" @if(isset($edit->file)) value="{{$edit->file}}" @endif />
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                              </span>
                            </div>
                @error('ld_file')<span class="mandatory_sign">{{ $message }}</span>@enderror
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
                    <input type="hidden"   value="{{ route('development.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script>  
         