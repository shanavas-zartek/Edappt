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
         
            <form class="form-sample"  method="POST" id="form1"  >
                    {{ csrf_field() }}
                    
                    @if(isset($show))                    
                      <div class="row"> 
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  value="{{$show->first_name}}" readonly />                      
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" value="{{$show->last_name}}"  readonly />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Middle Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"   value="{{$show->middle_name}}"  readonly  />                     
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  value="{{$show->email}}"   readonly/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  value="{{$show->contact_no}}"   readonly />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alternate Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  value="{{$show->alternate_no}}"   readonly/>
                            </div>
                          </div>
                        </div>
                      </div>                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" value="{{$show->address}}"  readonly />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  value="{{$show->country_name}}"  readonly />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  value="{{$show->state_name}}"   readonly />
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">District</label>
                            <div class="col-sm-9">
                            <input type="text"  class="form-control"   value="{{$show->district_name}}"   readonly />                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control"  value="{{$show->city_name}}"  readonly />
                            </div>
                          </div>
                        </div>
                     
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pincode</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  value="{{$show->pincode}}"  readonly  />
                            </div>
                          </div>
                        </div>
                        
                        
                        
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Verification Status</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if ($show->mobile_verified_status == 1) value="Verified" @else ($show->mobile_verified_status == 0) value="Not Verified" @endif  readonly  />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Verified On</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"   value="{{$show->mobile_verified_on}}"  readonly  />
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if ($show->is_active == 1) value="Active" @else ($show->is_active  == 0) value="Inactive" @endif   readonly  />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subscription Plan</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if (isset($show->package_name)) value="{{$show->package_name}}" @endif readonly  />                                
                            </div>
                          </div>
                        </div>                       
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Expiry Date</label>
                              <div class="col-sm-9">
                              <input type="text" class="form-control" @if (isset($show->subscription_expiry_date)) value="{{$show->subscription_expiry_date}}" @endif   readonly  />                                  
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Paid Amount</label>
                              <div class="col-sm-9">
                              <input type="text" class="form-control" @if (isset($show->paid_amount)) value="{{$show->paid_amount}}" @endif readonly  />                                
                              </div>
                            </div>
                          </div>                       
                          </div>
                        @endif
                      
                      
                  </form>
                  <p class="card-description">Student Details</p>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataSTD">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Student Code</th>                          
                          <th>Student Name</th>
                          <th>Grade</th>
                        </tr>
                      </thead>
                      <tbody>
                        
            <?php $i =1; ?>
            @if(isset($student_detail))

            @foreach ($student_detail as $row)
            <tr>
              <td>{{$i}}</td>
            
                <td><a href="{{URL::to('studentdetails/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->student_code}}</a></td>
                
                <td> {{$row->first_name.'  '.    $row->last_name}}</td>
                <td> {{$row->grade}}</td>
              </tr>
             <?php $i++; ?>
              @endforeach
            @endif
            </tbody>
                    </table>
                    
                    <br>
                  </div>                  
                  <p class="card-description">Subscription Details</p>                  
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataSP">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Subscription Plan</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Invoice Number</th>
                          <th>Invoice Date</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        
            <?php $i =1; ?>
            @if(isset($payments))

            @foreach ($payments as $row)
            <tr>
              <td>{{$i}}</td>            
                <td> {{$row->package_name}}</td>                
                <td> {{$row->subscription_start_date}}</td>
                <td> {{$row->subscription_end_date}}</td>
                <td> {{$row->invoice_no}}</td>
                <td> {{$row->invoice_date}}</td>
                <td> {{$row->paid_amount}}</td>
              </tr>
             <?php $i++; ?>
              @endforeach
            @endif
            </tbody>
                    </table>
                  </div>
                  </div>
              </div>              
            </div>
              </div>
          </div>
          @include('common.footer')
          
          
          
