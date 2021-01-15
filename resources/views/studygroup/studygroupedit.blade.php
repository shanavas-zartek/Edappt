@include('common.header')

@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Study Group </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Study Groups</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Study Group  </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
         
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Study Group </h4>
                  <form method="POST" id="form1" action="{{ route('studygroup.store')}}">
                    @csrf  
                    
                    <input type="hidden" class="form-control"  @if(isset($data->id)) value="{{$data->id}}" @endif name="hdr_id"  />
                    <div class="form-group">
                      <label for="student"> Select Student<span class="mandatory_sign">*</span></label>
                      <select class="duallistbox" multiple="multiple" name="studentlist[]" id="studentlist">
                     @foreach ($studentlist  as $row)

                  <option @if ($row->status == 1) selected @endif value="{{ $row->id }}"  >{{ $row->student_code.' '.$row->first_name.' '.$row->last_name  }}</option>
                 
                    @endforeach
                    
                    @error('studentlist[]')<span class="mandatory_sign">{{ $message }}</span>@enderror
                      </select>
                    </div>
                   
                    <div class="form-group">
                      <label for="Group Name">Group Name<span class="mandatory_sign">*</span></label>
                     <input type="text" name="group_name" class="form-control" value="{{$data->group_name}} "> 
                     @error('group_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Status">Status<span class="mandatory_sign">*</span></label>
                        <select name="status" class="form-control" >
                        <option value="">--- Select  ---</option>
                        <option @if(isset($data->is_active) && ($data->is_active == 1)) selected @endif value="1"  >Active</option>
                        <option @if(isset($data->is_active) && ($data->is_active == 0)) selected @endif value="0" >Inactive </option>
                        </select>
                        @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('studygroup.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
          
         