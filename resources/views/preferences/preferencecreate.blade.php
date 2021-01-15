 @include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Preference Category</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Preferences</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Preference Category </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Preference Category</h4>
                  <form method="POST" id="form1" action="{{ route('preferences.store')}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="pref_cat_id"  />
                    <input type="hidden" class="form-control" @if(isset($edit->image)) value="{{$edit->image}}" @endif name="image"  />
                    <div class="form-group">
                      <label for="Category name">Category Name<span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->category_name)) value="{{$edit->category_name}}" @endif name="category_name" id="category_name" placeholder="Category Name" />
                      @error('category_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Description">Description</label>
                     <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                    </div>
                    <div class="form-group">
                      <label for="Age group">Age Group<span class="mandatory_sign">*</span></label>
                      <select name="age" class="form-control" >
                    <option value="">--- Select  ---</option>
                    @foreach ($age  as $key => $value)
                    
                    <option @if(isset($edit->age_group_id) && ($edit->age_group_id == $key)) selected @endif value="{{ $key }}"  >{{ $value }}</option>
                    
                    @endforeach
                    
                </select>
                @error('age')<span class="mandatory_sign">{{ $message }}</span>@enderror
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
                    
                    <div class="form-group">
                        <label>Image upload</label>
                        <br>
                        @if(isset($edit->image))
                         <img  src="{{ url('uploads/Preferences/'.$edit->image) }}"  height="100" width="100" alt="{{$edit->image}}">
                        @endif
                        <input type="file" name="image" class="file-upload-default" @if(isset($edit->image)) value="{{$edit->image}}" @endif />
                        <div class="input-group col-xs-12">
                          <input type="text" name="image" class="form-control file-upload-info" disabled placeholder="Upload Image" />
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                          </span>
                        </div>
                      </div>
                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('preferences.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
         
