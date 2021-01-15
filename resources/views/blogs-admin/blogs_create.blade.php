 @include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Admin Blogs</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Blogs </a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Admin </li>
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
                  <form method="POST" id="form1" action="{{ route('adminblogs.store')}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="admin_blog_id"  />
                    <div class="row">
                      <div class="col-md-6">
                    <div class="form-group">
                      <label for="Title">Title <span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->blog_title)) value="{{$edit->blog_title}}" @endif name="blog_title" id="blog_title" placeholder="Blog Title" />
                      @error('blog_title')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Published From">Published From <span class="mandatory_sign">*</span></label>
                        <input type="date" name="published_from" class="form-control" @if(isset($edit->published_from)) value="{{$edit->published_from}}" @endif  placeholder="Published From Date" />
                        @error('published_from')<span class="mandatory_sign">{{ $message }}</span>@enderror
                      </div>
                    </div>
                </div>
               
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                           
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
                              <label for="Blog Main Image">Blog Main Image</label><br>
                              @if(isset($edit->image1))
                              <input type="hidden" name="image1" value="{{$edit->image1}}">
                         <img  src="{{ url('uploads/blogs/'.$edit->image1) }}"  height="150" width="150" alt="{{$edit->image1}}">
                        @endif
                              <input type="file" name="blog_main_img" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image"  name="image1"/>
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                              </span>
                            </div>
                             
                            </div>
                          </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="Blog Image">Blog Image</label>
                            <br>
                              @if(isset($edit->image2))
                              <input type="hidden" name="image2" value="{{$edit->image2}}">
                         <img  src="{{ url('uploads/blogs/'.$edit->image2) }}"  height="150" width="150" alt="{{$edit->image2}}">
                        @endif
                            <input type="file" name="blog_sub_img" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" name="image2"/>
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                              </span>
                            </div>
                              
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
                </div>

                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('adminblogs.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 