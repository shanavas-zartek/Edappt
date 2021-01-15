 @include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Company Settings</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Settings</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Company Settings </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Company Details</h4>
                  <form class="form-sample" action="javascript:void(0)" method="post" role="form" id="company_settings_frm">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="comp_id"  id="comp_id"  @if(isset($data->id)) value="{{$data->id}}" @endif/>
                    <!-- <p class="card-description">Personal info</p> -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label"> Name<span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" placeholder="Company Name" id="name" @if(isset($data->name)) value="{{$data->name}}" @endif/>
                            <span name="err_name" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Email<span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                            <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" @if(isset($data->email)) value="{{$data->email}}" @endif/>
                            <span name="err_email" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Phone<span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone" @if(isset($data->phone)) value="{{$data->phone}}" @endif/>
                            <span name="err_phone" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Contact Person</label>
                          <div class="col-sm-8">
                            <input class="form-control" placeholder="Contact Person Name" name="contact_person" id="contact_person" @if(isset($data->contact_person)) value="{{$data->contact_person}}" @endif/>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <p class="card-description">Address</p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Address 1 <span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Address1" name="address1" id="address1" @if(isset($data->address1)) value="{{$data->address1}}" @endif/>
                            <span name="err_address1" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Address 2</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Address2" name="address2"  id="address2" @if(isset($data->address2)) value="{{$data->address2}}" @endif/>
                            
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Postcode <span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Postcode" name="postcode"  id="postcode" @if(isset($data->pincode)) value="{{$data->pincode}}" @endif/>
                            <span name="err_postcode" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Country <span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                          <select name="country" id="country" class="form-control">
                              <option value="">--- Select  ---</option>
                                 @foreach ($countries  as $key => $value)

                                <option @if(isset($data->country) && ($data->country == $key)) selected @endif value="{{ $key }}"  >{{ $value }}</option>
                    
                                @endforeach
                              </select>
                            <span name="err_country" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">State <span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                          <select name="state" id="state" class="form-control">
                            <option value="">--- Select  ---</option>
                            @if(isset($data->state))

                            @foreach ($states  as $key => $value)

                          <option  @if($data->state == $key) selected @endif  value="{{ $key }}"   >{{ $value }}</option>


                          @endforeach
                          @endif 			

                              </select>
                            <span name="err_state" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">District <span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                          <select name="district" id="district" class="form-control">
                            <option value="">--- Select  ---</option>
                            @if(isset($data->district))

                            @foreach ($districts  as $key => $value)

                          <option @if ($data->district == $key) selected @endif  value="{{ $key }}"   >{{ $value }}</option>


                          @endforeach
                          @endif 							

                                
                              </select>
                            <span name="err_district" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                     </div>
                     <div class="row">
                   
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">City <span class="mandatory_sign">*</span></label>
                          <div class="col-sm-8">
                          <select name="city" id="city" class="form-control">
                            <option value="">--- Select  ---</option>
                           			
                            @if(isset($data->city))

                            @foreach ($cities  as $key => $value)

                            <option  @if($data->city == $key) selected @endif  value="{{ $key }}"   >{{ $value }}</option>


                            @endforeach
                            @endif 			
                                
                              </select>
                            <span name="err_city" class="mandatory_sign validerror_msg"></span>
                          </div>
                        </div>
                      </div>
                     </div>
                      <button type="submit" class="btn btn-primary mr-2" id="btn_frm_submit"> Submit </button>
                      <input type="hidden"   value="{{ route('company')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/company_settings.js') }}"></script>
          <script src="{{ asset('js/country_state_district_city.js') }}"></script>
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
