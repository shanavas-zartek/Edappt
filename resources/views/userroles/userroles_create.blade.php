@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">User Roles</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Settings</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> User Roles </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <!-- <h4 class="card-title">Role Details</h4> -->
                  <form class="form-sample" action="{{ route('userrole.store')}}" method="POST" id="role_frm">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="role_id"  id="role_id"  @if(isset($edit->id)) value="{{$edit->id}}" @endif/>
                    <div class="row">
             <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Role Details</h4>
                   
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Role Name <span class="mandatory_sign">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" @if(isset($edit->name)) value="{{$edit->name}}" @endif name="role_name" placeholder="Role Name" />
                          @error('role_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                         <textarea class="form-control" name="description"> @if(isset($edit->description)) {{$edit->description}} @endif </textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Status <span class="mandatory_sign">*</span></label>
                        <div class="col-sm-9">
                          <select name="status" class="form-control" >
                            <option value="">Select</option>
                            <option @if(isset($edit->is_active) && ($edit->is_active == 1)) selected @endif value="1"  >Active</option>
                            <option @if(isset($edit->is_active) && ($edit->is_active == 0)) selected @endif value="0" >Inactive </option>
                        </select>
                        @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                        </div>
                      </div>
                      </div>
                </div>
              </div>
                <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">User Permissions</h4>
                    <label class="col-sm-12 col-form-label">Add permissions for role <span class="mandatory_sign">*</span></label>
                    <input  type="checkbox" name="all" id="CheckAll" >
                    <label for=""><b>Select All</b></label>
                      <div class="form-group row">
                        @if(isset($permissions))
                        @foreach($permissions as $row)
                        <div class="col-sm-9">
                            <input class="checkBoxClass"  @if(in_array($row->id, $exist_permission)){{"checked"}}@endif type="checkbox" name="role_permission[]" value="{{$row->id}}">
                            <label for="">{{$row->display_name}}</label>
                        </div>
                 
                       @endforeach
                       @endif
                       @error('role_permission')<span class="mandatory_sign">{{ $message }}</span>@enderror  
                      </div>
                  
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary mr-2"> Submit </button>
              <input type="hidden"   value="{{ route('userrole.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/role.js') }}"></script>
          <script src="{{ asset('js/cancel_confirm.js') }}"></script>
