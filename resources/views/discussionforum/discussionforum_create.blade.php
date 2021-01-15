 @include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Discussion Forum</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Discussion Forum </a></li>
                  <li class="breadcrumb-item active" aria-current="page">Discussion Forum</li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-12">
                <div class="card-body">
                  <h4 class="card-title">Discussion Forum</h4>
                  <form method="POST" id="form1" action="{{ route('discussionforum.store')}}"  enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="hdr_id"  />
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="Topic">Topic <span class="mandatory_sign">*</span></label>
                         <input type="text" class="form-control" @if(isset($edit->topic)) value="{{$edit->topic}}" @endif name="topic" id="topic" placeholder="Topic" />
                           @error('topic')<span class="mandatory_sign">{{ $message }}</span>@enderror
                        </div>
                    </div>
                      <div class="col-md-6">
                    <div class="form-group">
                        <label for="Discussion Forum Category">Discussion Forum Category<span class="mandatory_sign">*</span></label>
                        <select name="discussion_category_id" class="form-control">
                       <option value="">Select</option>
                       @if(isset($discussioncategory))
                      @foreach($discussioncategory as $row)
                      <option @if(isset($edit->discussion_category_id) && ($edit->discussion_category_id == $row->id)) selected @endif value="{{$row->id}}">{{$row->category_name}}</option>
                      @endforeach
                       @endif
                       </select>
                        @error('discussion_category_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                      </div>
                    </div>
                </div>
                    <div class="row">
                      
                 
                   

                        <div class="col-md-6">
                          <div class="form-group">
                          <label for="Description">Description</label>
                           <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                            @error('description')<span class="mandatory_sign">{{ $message }}</span>@enderror 
                          </div>
                          </div>
                          <div class="col-md-6">
                    <div class="form-group">
                        <label for="Start Date">Start Date<span class="mandatory_sign">*</span></label>
                        <input type="date" name="start_date" class="form-control" @if(isset($edit->start_date)) value="{{$edit->start_date}}" @endif  placeholder="start_date" />
                        @error('start_date')<span class="mandatory_sign">{{ $message }}</span>@enderror
                      </div>
                    </div>
                     </div>
                     <div class="row">
                     
               
               
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="End Date">End Date <span class="mandatory_sign">*</span></label>
                            <input type="date" class="form-control"  name="end_date" id="end_date" placeholder="end_date" @if(isset($edit->end_date)) value="{{$edit->end_date}}" @endif />
                            @error('end_date')<span class="mandatory_sign">{{ $message }}</span>@enderror
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
                      <img src="{{ url('uploads/DiscussionForum/'.$edit->image) }}"  height="150" width="150" alt="{{$edit->image}}">
                      @endif
                      <input type="file" name="image" class="file-upload-default" />
                      <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image"  name="image"/>
                      <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                     </span>
                   </div>
         </div>
                          </div>
                    
                   
                     </div>


                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('discussionforum.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
