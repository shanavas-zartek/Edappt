@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student Achievements</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Student</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Achievements </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Student Achievements</h4>
                  <form method="POST" id="form1" action="{{ route('achievements.store')}}">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($data->id)) value="{{$data->id}}" @endif name="archievemnt_id"  />
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input readonly type="text" class="form-control" @if(isset($data->first_name)) value="{{$data->first_name." ".$data->middle_name." ".$data->last_name}}" @endif  />
                     
                    </div>
                    <div class="form-group">
                      <label for="Achievement">Achievement</label>
                     <input type="text" class="form-control" @if(isset($data->title)) value="{{$data->title }}"" @endif readonly> 
                    </div>
                    <div class="form-group">
                      <label for="Preference Category">Preference Category</label>
                     <input type="text" class="form-control" @if(isset($data->category_name)) value="{{$data->category_name }}"" @endif readonly> 
                    </div>
                    @if(isset($data->image))
                    <div class="form-group">
                      <label for="Image">Image</label>
                    <img src="" height="200px" width="200px">
                    </div>
                    @endif
                    <div class="form-group">
                    <label for="">Approval Status </label>
                    <select name="approval_status" class="form-control">
                    <option value="">Select</option>
                    <option @if($data->approval_status == 1)selected  @endif value="1">Approved</option>
                    <option @if($data->approval_status == 2) selected @endif value="2" >Rejected</option>
                    <option @if($data->approval_status == 0) selected @endif value="0" >Not Approved</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="Status">Status </label>
                    <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option @if(isset($data->is_active) && ($data->is_active == 1)) selected @endif value="1">Active</option>
                    <option @if(isset($data->is_active) && ($data->is_active == 0) ) selected @endif value="0">Inactive</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('achievements.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
          