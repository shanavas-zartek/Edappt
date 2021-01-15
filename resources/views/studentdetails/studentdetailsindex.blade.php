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
            <section class="content">  
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                          </div> <!-- end .flash-message -->
                    <h4 class="card-title">Student Details</h4>
                   
                  
                
</br>
</br>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th> Name</th>
                            
                            <th>Grade</th>
                            
                            <th>Syllabus</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
              <?php $i =1; ?>
              @if(isset($data))

              @foreach ($data as $row)
              <tr>
                <td>{{$i}}</td>
              
                  <td><a href="{{URL::to('studentdetails/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->first_name.'  '.    $row->last_name}}</a></td>
                 
                  
                  <td> {{$row->grade}}</td>
                 
                  <td> {{$row->syllabus}}</td>
                  <td> {{$row->contact_no}}</td>
                  <td> {{$row->email}}</td>
                  
                  
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td ><a href="{{URL::to('studentdetails/delete/'.$row->id) }}" onclick="return confirm_click();" data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a>
                  <a href="{{URL::to('studentdetails/show/'.$row->id) }}" data-toggle="tooltip" title="view" class="btn btn-sm btn-primary">View</a></td>
                  
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
          </div>
          @include('common.footer')
          <script src="{{ asset('js/confirmation.js') }}"></script>
