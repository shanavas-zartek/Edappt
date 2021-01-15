@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Posts</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Student</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Posts </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Posts</h4>
                  <form method="POST" id="form1" enctype="multipart/form-data" >
                    @csrf  
                   
                    <div class="form-group">
                      <label for="Name">Student Name</label>
                      <input readonly type="text" class="form-control" @if(isset($data->first_name)) value="{{$data->first_name." ".$data->middle_name." ".$data->last_name}}" @endif readonly  />
                     
                    </div>
                    <div class="form-group">
                      <label for="Topic">Topic</label>
                     <input type="text" class="form-control" @if(isset($data->topic)) value="{{$data->topic }}"" @endif readonly> 
                    </div>
                    @if(isset($data->description)) 
                    <div class="form-group">
                      <label for="Description">Description</label>
                      <textarea name="description" class="form-control"   readonly>  {{$data->description}} </textarea> 
                    </div>
                    @endif
                    @if(isset($data->file))
                    <div class="form-group">
                      <label for="file">File</label><br>
                      @if(isset($data->file_type)&&($data->file_type=='image')) 
                        <img src="{{ url('uploads/StudentPostings/'.$data->file) }}" height="200px" width="200px">
                     @elseif(isset($data->file_type)&&($data->file_type=='video')) 

                        <video  class="video-js" controls preload="auto" width="300" height="300" data-setup="{}">
                            <source src="{{ url('uploads/StudentPostings/'.$data->file) }}" type='video/mp4'>
                        </video>
                    @endif
                    </div>
                    @endif
                   
                    <div class="form-group">
                    <label for="Status">Status </label>
                    <select name="status" class="form-control">
                    
                    <option @if(isset($data->is_active) && ($data->is_active == 1)) selected @endif value="1">Active</option>
                    <option @if(isset($data->is_active) && ($data->is_active == 0) ) selected @endif value="0">Inactive</option>
                    </select>
                    </div>
                   
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
         
