@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">DSA Details</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">DSA Information</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> DSA Details </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">DSA Details</h4>
         
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
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  value="{{$show->email}}"   readonly/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  value="{{$show->contact_no}}"   readonly />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        
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
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" @if ($show->is_active == 1) value="Active" @else ($show->is_active  == 0) value="Inactive" @endif   readonly  />
                            </div>
                          </div>
                        </div>
                        </div>
                        @endif
                      
                      
                  </form>
                  <a href="{{URL::to('vendors/create/'.$show->id) }}" class="btn btn-primary btn-rounded btn-fw float-right">Add Vendor</a>
                  <p class="card-description">Vendor Details</p>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataSTD">
                      <thead>
                        <tr>
                          <th>#</th>
                                                  
                          <th> Name</th>
                            
                            <th>Subject</th>
                            <th>Vendor Category</th>
                            <th>Age Group</th>
                            <th>Qualification</th>
                            <th>Experience</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
            <?php $i =1; ?>
            @if(isset($vendor_detail))

            @foreach ($vendor_detail as $row)
            <tr>
              <td>{{$i}}</td>
            
               
              <td><a href="{{URL::to('vendors/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->first_name.'  '.    $row->last_name}}</a></td>
                  
                  <td> {{$row->subject}}</td>
                  <td> {{$row->category}}</td>
                  <td> {{$row->age_group}}</td>
                  
                  <td> {{$row->qualification}}</td>
                  <td> {{$row->experience}}</td>
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td><a href="{{URL::to('vendors/delete/'.$row->id) }}" onclick="return confirm_click();"  data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a></td>
              </tr>
             <?php $i++; ?>
              @endforeach
            @endif
            </tbody>
                    </table>
                    
                    <br>
                  </div>                  
                 
                  </div>
              </div>              
            </div>
              </div>
          </div>
          @include('common.footer')
          