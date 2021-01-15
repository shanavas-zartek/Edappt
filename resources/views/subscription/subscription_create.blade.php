 @include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Subscription Plans</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Subscription </a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Plans </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-12">
                <div class="card-body">
                  <h4 class="card-title">Plan</h4>
                  <form method="POST" id="subscription_frm" action="{{ route('subscription.store')}}">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="plan_id"  />
                    <div class="row">
                      <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name <span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->package_name)) value="{{$edit->package_name}}" @endif name="package_name" id="package_name" placeholder="Subscription Plan Name" />
                      @error('package_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Start Date <span class="mandatory_sign">*</span></label>
                        <input type="date" id="start_date" name="start_date" class="form-control" @if(isset($edit->start_date)) value="{{$edit->start_date}}" @endif name="start_date" id="name" placeholder="Start Date" />
                        @error('start_date')<span  class="mandatory_sign">{{ $message }}</span>@enderror
                      </div>
                    </div>
                </div>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Plan Amount <span class="mandatory_sign">*</span></label>
                      <input type="number" name="amount" class="form-control" id="description" @if(isset($edit->amount))value="{{$edit->amount}}" @endif placeholder="Subscription Amount">
                      @error('amount')<span class="mandatory_sign">{{ $message }}</span>@enderror 
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputUsername1">End Date <span class="mandatory_sign">*</span></label>
                            <input type="date" id="end_date" class="form-control" @if(isset($edit->end_date)) value="{{$edit->end_date}}" @endif name="end_date" name="end_date" id="end_date" placeholder="End Date" />
                            @error('end_date')<span name="date_range_valid" class="mandatory_sign">{{ $message }}</span>@enderror
                          </div>
                        </div>
                     </div>
                   <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Plan Duration <span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->duration)) value="{{$edit->duration}}" @endif name="duration" id="duration" placeholder="Plan Duration" />
                      @error('duration')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                         <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                        </div>
                        </div>
                     </div>

                  <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Status <span class="mandatory_sign">*</span></label>
                    <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 1)){ selected }@endif value="1">Active</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 0) ){selected} @endif value="0">Inactive</option>
                    </select>
                    @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    </div>
                </div>

                    <button id="btn_submit" type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('subscription.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/subscription.js') }}"></script>
          <script src="{{ asset('js/cancel_confirm.js') }}"></script>
