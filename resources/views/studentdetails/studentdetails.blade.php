@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student Details</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Student</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Student Details </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Student Details</h4>
                  <form class="form-sample"  method="POST" id="form1" action="{{ route('studentdetails.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="student_id"  />
                    <input type="hidden" class="form-control" @if(isset($edit->image)) value="{{$edit->image}}" @endif name="image"  />
                    <p class="card-description">Personal info</p>
                      <div class="row"> 
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($edit->first_name)) value="{{$edit->first_name}}" @endif name="first_name" id="first_name" placeholder="First Name " />
                      @error('first_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"@if(isset($edit->last_name)) value="{{$edit->last_name}}" @endif name="last_name" id="last_name" placeholder="Last Name " />
                      @error('last_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Middle Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Middle Name" @if(isset($edit->middle_name)) value="{{$edit->middle_name}}" @endif name="middle_name" id="middle_name"  />
                     
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                            <select name="gender" class="form-control">
                              <option value="">--- Select  ---</option>
                              <option @if(isset($edit->gender)&& ($edit->gender == 'Male') ) selected @endif value="Male"  >Male</option>
                              <option @if(isset($edit->gender)&& ($edit->gender == 'Female') ) selected @endif value="Female"  >Female</option>
                    
                              </select>
                              @error('gender')<span class="mandatory_sign">{{ $message }}</span>@enderror
                     
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date Of Birth<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" placeholder="dd/mm/yyyy" @if(isset($edit->dob)) value="{{$edit->dob}}" @endif name="dob" id="dob"  />
                      @error('dob')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact Number<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($edit->contact_no)) value="{{$edit->contact_no}}" @endif name="contact_no" id="contact_no" placeholder="Phone" />
                      @error('contact_no')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="email" class="form-control" @if(isset($edit->email)) value="{{$edit->email}}" @endif placeholder="Email Address" name="email" id="email"/>
                      @error('email')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="card-description">Address</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address <span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($edit->address)) value="{{$edit->address}}" @endif name="address" id="address" placeholder="Address " />
                      @error('address')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                            <select name="country" id="country" class="form-control">
                              <option value="">--- Select  ---</option>
                                 @foreach ($countries  as $key => $value)

                                <option @if(isset($edit->country) && ($edit->country == $key)) selected @endif value="{{ $key }}"  >{{ $value }}</option>
                    
                                @endforeach
                              </select>
                              
                      @error('country')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                            <select name="state" id="state" class="form-control">
                            <option value="">--- Select  ---</option>
                            @if(isset($edit->state))

                            @foreach ($states  as $key => $value)

                            <option @if ($edit->state == $key) selected @endif  value="{{ $key }}"   >{{ $value }}</option>


                        @endforeach
                        @endif 

                              </select>
                      @error('state')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">District<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                            <select name="district" id="district" class="form-control">
                            <option value="">--- Select  ---</option>
                            @if(isset($edit->district))

                            @foreach ($districts  as $key => $value)

                          <option @if ($edit->district == $key) selected @endif  value="{{ $key }}"   >{{ $value }}</option>


                          @endforeach
                          @endif 							

                                
                              </select>
                              @error('district')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                            <select name="city" id="city" class="form-control">
                            <option value="">--- Select  ---</option>
                            @if(isset($edit->city))

                            @foreach ($cities  as $key => $value)

                          <option @if ($edit->city == $key) selected @endif  value="{{ $key }}"   >{{ $value }}</option>


                          @endforeach
                          @endif 							

                                
                              </select>
                      @error('city')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pincode<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($edit->pincode)) value="{{$edit->pincode}}" @endif name="pincode" id="pincode" placeholder="Pincode " />
                      @error('pincode')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        
                        
                        
                      </div>
                      <p class="card-description">Student Details</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grade<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              
                            <input type="text" class="form-control" @if(isset($edit->grade)) value="{{$edit->grade}}" @endif name="grade" id="grade" placeholder="Grade " />
                      @error('grade')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">School </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if(isset($edit->school)) value="{{$edit->school}}" @endif name="school" id="school" placeholder="School " />
                      @error('school')<span class="mandatory_sign">{{ $message }}</span>@enderror
                     
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student Code<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              
                            <input type="text" class="form-control" @if(isset($edit->student_code)) value="{{$edit->student_code}}" @endif name="student_code" id="student_code" placeholder="Student Code " />
                      @error('student_code')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Syllabus<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                            <textarea name="syllabus" class="form-control" id="syllabus"> @if(isset($edit->syllabus)) {{$edit->syllabus}} @endif</textarea>
                             
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pet Name </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if(isset($edit->pet_name)) value="{{$edit->pet_name}}" @endif name="pet_name" id="pet_name" placeholder="Pet Name " />
                      @error('pet_name')<span class="mandatory_sign">{{ $message }}</span>@enderror
                     
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Best Friend </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if(isset($edit->best_friend)) value="{{$edit->best_friend}}" @endif name="best_friend" id="best_friend" placeholder="Best Friend " />
                      @error('best_friend')<span class="mandatory_sign">{{ $message }}</span>@enderror
                     
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dream<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              
                            <input type="text" class="form-control" @if(isset($edit->dream)) value="{{$edit->dream}}" @endif name="dream" id="dream" placeholder="Dream " />
                      @error('dream')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                            <select name="status" class="form-control" >
                            <option value="">--- Select  ---</option>
                    
                                <option @if(isset($edit->is_active) && ($edit->is_active == 1)) selected @endif value="1"  >Active</option>
                    
                                <option @if(isset($edit->is_active) && ($edit->is_active == 0)) selected @endif value="0" >Inactive </option>
                    
                    
                    
                    
                            </select>
                                @error('status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                         
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                            @if(isset($edit->image))
                         <img  src="{{ url('uploads/Students/'.$edit->image) }}"  height="100" width="100" alt="{{$edit->image}}">
                        @endif
                        <input type="file" name="image"  class="file-upload-default" />
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" />
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                          </span>
                        </div>
                        
                                
                            </div>
                          </div>
                        </div>
                       
                        </div>
                      <button type="submit" class="btn btn-primary mr-2" > Submit </button>
                      <input type="hidden"   value="{{ route('studentdetails.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer')
          <script src="{{ asset('js/country_state_district_city.js') }}"></script>
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
          
          
