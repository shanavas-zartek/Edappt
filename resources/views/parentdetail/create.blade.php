@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Parent Details</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Parent Details</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Parent Details </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Parent Details</h4>
                  <form class="form-sample"  method="POST" id="form1" action="{{ route('parentdetail.store')}}" >
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" @if(isset($edit->id)) value="{{$edit->id}}" @endif name="parent_id"  />
                    
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
                            <label class="col-sm-3 col-form-label">Email<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="email" class="form-control" @if(isset($edit->email)) value="{{$edit->email}}" @endif placeholder="Email Address" name="email" id="email"/>
                      @error('email')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact Number<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($edit->contact_no)) value="{{$edit->contact_no}}" @endif name="contact_no" id="contact_no" placeholder="Phone" />
                      @error('contact_no')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alternate Number<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" @if(isset($edit->alternate_no)) value="{{$edit->alternate_no}}" @endif name="alternate_no" id="alternate_no" placeholder="Alternate Number " />
                      @error('alternate_no')<span class="mandatory_sign">{{ $message }}</span>@enderror
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
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Verification Status<span class="mandatory_sign">*</span></label>
                            <div class="col-sm-9">
                              <select name="mobile_verified_status" class="form-control">
                              <option value="">--- Select  ---</option>
                    
                                <option @if(isset($edit->mobile_verified_status) && ($edit->mobile_verified_status == 1)) selected @endif value="1"  >Verified</option>
                    
                                <option @if(isset($edit->mobile_verified_status) && ($edit->mobile_verified_status == 0)) selected @endif value="0" >Not Verified </option>
                    
                    
                    
                    
                            </select>
                                @error('mobile_verified_status')<span class="mandatory_sign">{{ $message }}</span>@enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Verified On</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" placeholder="dd/mm/yyyy" @if(isset($edit->mobile_verified_on)) value="{{$edit->mobile_verified_on}}" @endif name="mobile_verified_on" id="mobile_verified_on"  />
                     
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
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
                      <button type="submit" class="btn btn-primary mr-2" > Submit </button>
                      <input type="hidden"   value="{{ route('parentdetail.index')}}"   id="hdn_url" name="hdn_url"  />
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
          
          
