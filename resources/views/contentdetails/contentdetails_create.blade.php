@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Content details</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Activities </a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Content details </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-12">
                <div class="card-body">
                  <h4 class="card-title">Content Details</h4>
                  <form method="POST" id="form1" action="{{ route('details.store')}}"  enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="hdr_id"  />
                    <div class="row">
                      <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">Name <span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->name)) value="{{$edit->name}}" @endif name="name" id="ame" placeholder=" Name" />
                      @error('name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Content Category">Content Category<span class="mandatory_sign">*</span></label>
                        <select name="content_category_id" class="form-control">
                       <option value="">Select</option>
                       @if(isset($category))
                      @foreach($category as $row)
                      <option @if(isset($edit->content_category_id) && ($edit->content_category_id == $row->id)) selected @endif value="{{$row->id}}">{{$row->category}}</option>
                      @endforeach
                       @endif
                       </select>
                        @error('content_category_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                      </div>
                    </div>
                </div>
                    <div class="row">
                      
                 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Subject">Subject <span class="mandatory_sign">*</span></label>
                            <select name="subject_id" class="form-control">
                       <option value="">Select</option>
                       @if(isset($subject))
                      @foreach($subject as $subrow)
                      <option  @if(isset($edit->subject_id) && ($edit->subject_id == $subrow->id)) selected @endif  value="{{$subrow->id}}">{{$subrow->subject}}</option>
                      @endforeach
                       @endif
                       </select>
                            @error('subject_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                          <label for="Description">Description</label>
                           <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                            @error('description')<span class="mandatory_sign">{{ $message }}</span>@enderror 
                          </div>
                          </div>
                     </div>
                     <div class="row">
                      <div class="col-md-6">
                    <div class="form-group">
                      <label for="Duration">Duration <span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->duration)) value="{{$edit->duration}}" @endif name="duration" id="duration" placeholder="Duration" />
                      @error('duration')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group">
                        <label for="Status">Status <span class="mandatory_sign">*</span></label>
                    <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 1)){ selected }@endif value="1">Active</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 0) ) selected @endif value="0">Inactive</option>
                    </select>
                    @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                        </div>
                        </div>
                </div>
                   <div class="row">
                    
                    
                    

              <div class="col-md-6">
               <div class="form-group">
                   <label for="Image">Image</label><br>
                   @if(isset($edit->image))
                    <input type="hidden" name="old_image" value="{{$edit->image}}">
                      <img src="{{ url('uploads/ContentDetails/'.$edit->image) }}"  height="150" width="150" alt="{{$edit->image}}">
                      @endif
                      <input type="file" name="content_image" class="file-upload-default" />
                      <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image"  name="image1"/>
                      <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                     </span>
                   </div>
         </div>
                          </div>
                     </div>


                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('details.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
