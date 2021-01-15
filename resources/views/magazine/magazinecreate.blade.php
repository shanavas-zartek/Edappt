@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Magazine Upload</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Magazine</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Magazine</li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Add Magazine</h4>
                  <form method="POST" id="form1" action="{{ route('magazine.store')}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="id"  />
                    <div class="form-group">
                      <label for="Category name">Magazine Title<span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->title)) value="{{$edit->title}}" @endif name="title" id="title" placeholder="Magazine Title" />
                      @error('title')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Description">Description</label>
                     <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                    </div>

                    <div class="form-group">
                      <label for="Image">Upload PDF<span class="mandatory_sign">*</span></label><br>
                    @if(isset($edit->pdf_file))
                      <input type="hidden" name="pdf_file1" @if(isset($edit->pdf_file)) value="{{$edit->pdf_file}}" @endif>
                    @endif
                      <input type="file" name="pdf_file" class="file-upload-default" @if(isset($edit->pdf_file)) value="{{$edit->pdf_file}}" @endif/>
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload PDF"  name="pdf_file" @if(isset($edit->pdf_file)) value="{{$edit->pdf_file}}" @endif />
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                        </span>
                      </div>
                      @error('pdf_file')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                      <label for="Image">Poster Image<span class="mandatory_sign">*</span></label><br>
                    @if(isset($edit->poster_image))
                      <input type="hidden" name="poster_image1" @if(isset($edit->poster_image)) value="{{$edit->poster_image}}" @endif>
                      <img  src="{{ url('uploads/Magazine/'.$edit->poster_image) }}"  height="100" width="100" alt="{{$edit->poster_image}}">
                    @endif
                      <input type="file" name="poster_image" class="file-upload-default" @if(isset($edit->poster_image)) value="{{$edit->poster_image}}" @endif/>
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image"  name="poster_image" @if(isset($edit->poster_image)) value="{{$edit->poster_image}}" @endif />
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                        </span>
                      </div>
                      @error('poster_image')<span class="mandatory_sign">{{ $message }}</span>@enderror
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
                    <input type="hidden"   value="{{ route('magazine.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script>         