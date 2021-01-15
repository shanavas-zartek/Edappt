@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Teacher On Demand</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Requests</a></li>
                
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-12">
                <div class="card-body">
                  <h4 class="card-title">Requests</h4>
                  <form method="POST" id="form1" action="{{ route('teacher.approve')}}">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($data->id)) value="{{$data->id}}" @endif name="id"  />
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Name</label>
                          <div class="col-sm-8">
                        
                      <input readonly type="text" class="form-control" @if(isset($data->first_name)) value="{{$data->first_name." ".$data->middle_name." ".$data->last_name}}" @endif  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label" >Question</label>
                          <div class="col-sm-8">
                            <textarea name="question" class="form-control" readonly rows="3">{{$data->question}}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Requested Date</label>
                      <div class="col-sm-8">
                     <input type="text" class="form-control" @if(isset($data->requested_date)) value="{{$data->requested_date }}"" @endif readonly> 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Requested Time</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" @if(isset($data->requested_time)) value="{{$data->requested_time }}"" @endif readonly> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Actual start Date</label>
                      <div class="col-sm-8">
                     <input type="date" class="form-control"  name="start_date" @if(isset($data->approved_start_date)) value="{{$data->approved_start_date }}"" @endif > 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Actual start Time</label>
                          <div class="col-sm-8">
                            <input type="time" name="start_time" class="form-control" @if(isset($data->approved_start_time)) value="{{$data->approved_start_time }}"" @endif > 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Approval Status</label>
                      <div class="col-sm-8">
                        <select name="approval_status" class="form-control">
                          <option value="">Select</option>
                          <option @if($data->approval_status == 1)selected  @endif value="1">Approved</option>
                          <option @if($data->approval_status == 2) selected @endif value="2" >Rejected</option>
                          <option @if($data->approval_status == 0) selected @endif value="0" >Not Approved</option>
                          </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Status</label>
                          <div class="col-sm-8">
                            <select name="status" class="form-control">
                              <option value="">Select</option>
                              <option @if(isset($data->is_active) && ($data->is_active == 1)) selected @endif value="1">Active</option>
                              <option @if(isset($data->is_active) && ($data->is_active == 0) ) selected @endif value="0">Inactive</option>
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>

               
                   
                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('teacher.requested')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/company_settings.js') }}"></script>
          <script src="{{ asset('js/cancel_confirm.js') }}"></script>
