@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Book A Slot Approval</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Book A Slot</a></li>
                  
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Book A Slot Request</h4>
                  <form method="POST" id="book_slot_frm" action="{{ route('bookslot.store')}}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="book_slot_id"  id="book_slot_id"  @if(isset($data->id)) value="{{$data->id}}" @endif/>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label"> Name</label>
                          <div class="col-sm-8">
                          <input readonly type="text" class="form-control" @if(isset($data->first_name)) value="{{$data->first_name." ".$data->middle_name." ".$data->last_name}}" @endif  />
                           
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Topic</label>
                          <div class="col-sm-8">
                          <input type="text" class="form-control" @if(isset($data->topic)) value="{{$data->topic }}"" @endif readonly> 
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Description </label>
                          <div class="col-sm-10">
                            <textarea class="form-control" placeholder="Address1" name="description" id="description"/ rows="4" readonly> @if(isset($data->description)) {{$data->description}} @endif </textarea>
                            
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">File </label>
                          <div class="col-sm-10">
                          
                            <video width="320" height="240" controls>
                              <source src="{{ url('uploads/BookSlots/'.$data->file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Request Date </label>
                          <div class="col-sm-8">
                            <input type="date" class="form-control" placeholder="requested_date" readonly name="requested_date"  id="requested_date" @if(isset($data->requested_date)) value="{{$data->requested_date}}" @endif/>
                            
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Request Time </label>
                          <div class="col-sm-8">
                            <input type="time" class="form-control" placeholder="requested_time" readonly name="requested_time"  id="requested_time" @if(isset($data->requested_time)) value="{{$data->requested_time}}" @endif/>
                            <span name="err_postcode" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Start Date <span  class="mandatory_sign ">*</span></label>
                          <div class="col-sm-8">
                            <input type="date" class="form-control" placeholder="start date" name="start_date"  id="start_date" @if(isset($data->start_date)) value="{{$data->start_date}}" @endif/>
                            @error('start_date')<span class="mandatory_sign">{{ $message }}</span>@enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label"> Start Time <span  class="mandatory_sign ">*</span> </label>
                          <div class="col-sm-8">
                            <input type="time" class="form-control" placeholder="start_time" name="start_time"  id="start_time" @if(isset($data->start_time)) value="{{$data->start_time}}" @endif/>
                            @error('start_time')<span class="mandatory_sign">{{ $message }}</span>@enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">End Time <span  class="mandatory_sign ">*</span></label>
                          <div class="col-sm-8">
                            <input type="time" class="form-control" placeholder="end_time" name="end_time"  id="end_time" @if(isset($data->end_time)) value="{{$data->end_time}}" @endif/>
                            @error('end_time')<span class="mandatory_sign">{{ $message }}</span>@enderror
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Approval Status <span  class="mandatory_sign ">*</span></label>
                          <div class="col-sm-8">
                            <select name="approval_status" class="form-control">
                              <option value="">Select</option>
                              <option @if($data->approval_status == 1)selected  @endif value="1">Approved</option>
                              <option @if($data->approval_status == 2) selected @endif value="2" >Rejected</option>
                              <option @if($data->approval_status == 0) selected @endif value="0" >Not Approved</option>
                              </select>
                              @error('approval_status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Status<span  class="mandatory_sign ">*</span> </label>
                          <div class="col-sm-8">
                            <select name="status" class="form-control">
                              <option value="">Select</option>
                              <option @if(isset($data->is_active) && ($data->is_active == 1)) selected @endif value="1">Active</option>
                              <option @if(isset($data->is_active) && ($data->is_active == 0) ) selected @endif value="0">Inactive</option>
                              </select>
                              @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" id="btn_frm_submit"> Submit </button>
                      <input type="hidden"   value="{{ route('bookslot.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
         
          <script src="{{ asset('js/bookslot.js') }}"></script>
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
