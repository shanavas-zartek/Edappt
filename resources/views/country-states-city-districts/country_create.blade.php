@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Country List</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Settings</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Country List</li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>

            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Country List </h4>
                  <form method="POST" id="form1" action="{{ route('country.store')}}"  >
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="country_id"  />
                    
                    <div class="form-group">
                      <label for="Country">Country<span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->country_name)) value="{{$edit->country_name}}" @endif name="country_name" readonly />
                      
                    </div>
                   

                    <div class="form-group">
                      <label for="Status">Status<span class="mandatory_sign">*</span></label>
                        <select name="status" class="form-control" >
                        <option value="">--- Select  ---</option>
                        <option @if(isset($edit->is_active) && ($edit->is_active == 1)) selected @endif value="1"  >Active</option>
                        <option @if(isset($edit->is_active) && ($edit->is_active == 0)) selected @endif value="0" >Inactive </option>
                        </select>
                        @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    
                    
                    
                    
                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('country.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 