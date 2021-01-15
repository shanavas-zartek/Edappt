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
         
            <form class="form-sample"  method="POST" id="form1"  >
                    {{ csrf_field() }}
                    
                    @if(isset($show))
                    <p class="card-description">Personal info</p>
                      <div class="row"> 
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($show->first_name))  value="{{$show->first_name}}"  @endif  readonly />
                     
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  @if(isset($show->last_name)) value="{{$show->last_name}}"  @endif readonly />
                     
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      @if($show->middle_name)
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Middle Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  @if(isset($show->middle_name))  value="{{$show->middle_name}}" @endif readonly />
                     
                            </div>
                          </div>
                        </div>
                        @endif
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  @if(isset($show->gender))  value="{{$show->gender}}" @endif readonly    />
                     
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date Of Birth</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($show->dob))  value="{{$show->dob}}" @endif readonly    />
                    
                            </div>
                          </div>
                        </div>
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($show->email))  value="{{$show->email}}" @endif readonly   />
                    
                            </div>
                          </div>
                        </div>
                        
                        </div>
                        <div class="row">
                      
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  @if(isset($show->contact_no))  value="{{$show->contact_no}}" @endif readonly    />
                     
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
                              <input type="text" class="form-control" @if(isset($show->address))  value="{{$show->address}}" @endif readonly     readonly />
                    
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if(isset($show->country_name)) value="{{$show->country_name}}" @endif  readonly />
                              
                     
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  @if(isset($show->state_name)) value="{{$show->state_name}}" @endif    readonly />
                     
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">District</label>
                            <div class="col-sm-9">
                            <input type="text"  class="form-control"  @if(isset($show->district_name)) value="{{$show->district_name}}" @endif  readonly /> 
                             
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  @if(isset($show->city_name)) value="{{$show->city_name}}" @endif readonly  />
                      
                            </div>
                          </div>
                        </div>
                     
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pincode</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"   @if(isset($show->pincode))  value="{{$show->pincode}}" @endif readonly   />
                      
                            </div>
                          </div>
                        </div>
                        </div>
                        <p class="card-description">Student Details</p>
                        <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grade</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  @if(isset($show->grade))  value="{{$show->grade}}" @endif readonly />
                      
                            </div>
                          </div>
                        </div>
                     
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">School</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  @if(isset($show->school))  value="{{$show->school}}" @endif readonly  />
                     
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student Code</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  @if(isset($show->student_code))  value="{{$show->student_code}}" @endif readonly   />
                    
                            </div>
                          </div>
                        </div>
                     
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Syllabus</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  @if(isset($show->syllabus))  value="{{$show->syllabus}}" @endif readonly    />
                      
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pet Name </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"   @if(isset($show->pet_name))  value="{{$show->pet_name}}" @endif readonly    />
                      
                      
                     
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Best Friend </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  @if(isset($show->best_friend))  value="{{$show->best_friend}}" @endif readonly    />
                      
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dream</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"    @if(isset($show->dream))  value="{{$show->dream}}" @endif readonly    />
                     
                            </div>
                          </div>
                        </div>
                     
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Parent Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"     @if(isset($show->parentname))  value="{{$show->parentname}}" @endif readonly    />
                      
                            </div>
                          </div>
                        </div>
                        </div>
                      
                        <div class="row">
                        @if(isset($show->image))
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                           
                         <img  src="{{ url('uploads/Students/'.$show->image) }}"  height="100" width="100" alt="{{$show->image}}">
                       
                        
                                
                            </div>
                          </div>
                        </div>
                        @endif
                       
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if(isset($show->is_active)&& ($show->is_active == 1)) value="Active" @else ($show->is_active  == 0) value="Inactive" @endif   readonly  />
                               
                            </div>
                          </div>
                        </div>
                       
                        </div>
                        @endif
                      
                      
                  </form>
                  </div>
              </div>
            </div>
              </div>
          </div>
          @include('common.footer')
          
          
          
