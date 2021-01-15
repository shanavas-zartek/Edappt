@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Content Category</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Activities</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Content Category </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Content Category</h4>
                  <form method="POST" id="form1" action="{{ route('contentcategory.store')}}">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="content_cat_id"  />
                    <div class="form-group">
                      <label for="Category name">Category Name<span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->category)) value="{{$edit->category}}" @endif name="category" id="category" placeholder="Category Name" />
                      @error('category')<span class="mandatory_sign">{{ $message }}</span>@enderror
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
                      <label for="Day">Day<span class="mandatory_sign">*</span></label>
                          <select name="day" class="form-control">
                            <option value="">--- Select  ---</option>
                            <option @if(isset($edit->day)&& ($edit->day == 'Sunday') ) selected @endif value="Sunday"   >Sunday</option>
                            <option @if(isset($edit->day) && ($edit->day == 'Monday')) selected @endif value="Monday"  >Monday</option>
                            <option @if(isset($edit->day) && ($edit->day == 'Tuesday')) selected @endif value="Tuesday"  >Tuesday</option>
                            <option @if(isset($edit->day) && ($edit->day == 'Wednesday')) selected @endif value="Wednesday"  >Wednesday</option>
                            <option @if(isset($edit->day) && ($edit->day == 'Thursday')) selected @endif value="Thursday"  >Thursday</option>
                            <option @if(isset($edit->day) && ($edit->day == 'Friday')) selected @endif value="Friday"  >Friday</option>
                            <option @if(isset($edit->day) && ($edit->day == 'Saturday')) selected @endif value="Saturday"  >Saturday</option>
                          </select>
                          @error('day')<span class="mandatory_sign">{{ $message }}</span>@enderror
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
                    <input type="hidden"   value="{{ route('contentcategory.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
         
