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
                  <form method="POST" id="form1" action="{{ route('discussionforumdtl.store')}}"  enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="dtl_id"  />
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="Student Name">Student Name <span class="mandatory_sign">*</span></label>
                         <input type="text" class="form-control"  @if(isset($edit->first_name)) value="{{$edit->first_name." ".$edit->middle_name." ".$edit->last_name}}" @endif  readonly />
                          
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="Topic">Topic <span class="mandatory_sign">*</span></label>
                         <input type="text" class="form-control" @if(isset($edit->topic)) value="{{$edit->topic}}" @endif readonly />
                          
                        </div>
                    </div>
                      
                </div>
               
                    <div class="row">
                      
                 
                  

                        <div class="col-md-6">
                          <div class="form-group">
                          <label for="Reply">Relpy</label>
                          <input type="text" class="form-control" @if(isset($edit->reply)) value="{{$edit->reply}}" @endif readonly />
                            
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                          <label for="Like">Like</label>
                          <input type="text" class="form-control" @if(isset($edit->likes)&&$edit->likes== 1) value="Yes" @else value="No" @endif readonly />
                            
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
                    <option @if(isset($edit->is_active) && ($edit->is_active == 0) ) selected @endif value="0">Inactive</option>
                    </select>
                    @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                    <label for="Approval Status">Approval Status<span class="mandatory_sign">*</span> </label>
                    <select name="approved_status" class="form-control">
                    <option value="">Select</option>
                    <option @if($edit->approved_status == 1)selected  @endif value="1">Approved</option>
                    <option @if($edit->approved_status == 2) selected @endif value="2" >Rejected</option>
                    <option @if($edit->approved_status == 0) selected @endif value="0" >Not Approved</option>
                    </select>
                    @error('approved_status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                   </div>
                     </div>
                  


                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('discussionforumdtl.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script>