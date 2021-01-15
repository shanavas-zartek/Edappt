@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Course</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Course</a></li>
                  <li class="breadcrumb-item active" aria-current="page">  Course </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
          <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Course</h4>
                  <form method="POST" id="form1" action="{{ route('course.store')}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="id"  />
                    <div class="form-group">
                      <label for="Course Name">Course Name<span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" name="course_name" id="course_name" placeholder="Course Name" @if(isset($edit->course_name)) value="{{$edit->course_name}}" @endif  value="{{ old('course_name') }}"/>
                      @error('course_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Description">Description</label>
                     <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                    </div>
                    <div class="form-group">
                      <label for="Category">Category<span class="mandatory_sign">*</span></label>
                      <select name="ld_category_id" class="form-control" >
                        <option value="">Select</option>
                        @foreach ($ldcategory as $category)
                        <option @if(isset($edit->ld_category_id) && ($edit->ld_category_id == $category->id)) selected @endif value="{{ $category->id }}"  >{{ $category->category }}</option>
                        @endforeach      
                      </select>
                      @error('ld_category_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>   
                    <div class="form-group">
                      <label for="Age Group">Age Group<span class="mandatory_sign">*</span></label>
                      <select name="age_group_id" class="form-control" >
                        <option value="">Select</option>
                        @foreach ($agegroup as $age)
                        <option @if(isset($edit->age_group_id) && ($edit->age_group_id == $age->id)) selected @endif value="{{ $age->id }}"  >{{ $age->age_group }}</option>
                        @endforeach      
                      </select>
                      @error('age_group_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                   
                    <div class="form-group">
                      <label for="Vendor">Vendor<span class="mandatory_sign">*</span></label>
                      <select name="vendor_id" class="form-control" >
                        <option value="">Select</option>
                        @foreach ($vendors as $vendor)
                        <option @if(isset($edit->vendor_id) && ($edit->vendor_id == $vendor->id)) selected @endif value="{{ $vendor->id }}"  >{{ $vendor->first_name }}</option>
                        @endforeach
                      </select>
                      @error('vendor_id')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Image">Poster Video<span class="mandatory_sign">*</span></label><br>

                    @if(isset($edit->poster_image))
                      <input type="hidden" name="poster_image1" @if(isset($edit->poster_image)) value="{{$edit->poster_image}}" @endif>
                      <video class="video-js" controls preload="auto" width="300" height="300" data-setup="{}">
                          <source src="{{ url('uploads/Courses/'.$edit->poster_image) }}" >
                      </video>
                    @endif
                      <input type="file" name="poster_image" class="file-upload-default" @if(isset($edit->poster_image)) value="{{$edit->poster_image}}" @endif/>
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Video"  name="poster_image" @if(isset($edit->poster_image)) value="{{$edit->poster_image}}" @endif />
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                        </span>
                      </div>
                      @error('poster_image')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="Course Price">Course Price <span class="mandatory_sign">*</span></label>
                      <input type="number" name="course_price" class="form-control" id="course_price" @if(isset($edit->course_price))value="{{$edit->course_price}}" @endif placeholder="Course Price" value="{{ old('course_price') }}">
                      @error('course_price')<span class="mandatory_sign">{{ $message }}</span>@enderror 
                    </div>
                    <div class="form-group">
                      <label for="Status">Status<span class="mandatory_sign">*</span></label>
                      <select name="status" class="form-control" >
                    <option value="">Select</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 1)) selected @endif value="1"  >Active</option>
                    <option @if(isset($edit->is_active) && ($edit->is_active == 0)) selected @endif value="0" >Inactive </option>
                </select>
                @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                    </div>                    
                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('course.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer')
          <script src="{{ asset('js/cancel_confirm.js') }}"></script>