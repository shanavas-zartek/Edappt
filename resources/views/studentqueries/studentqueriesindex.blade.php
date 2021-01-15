@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student Queries</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Student</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Student Queries</li>
                </ol>
              </nav>
            </div>
            
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
                    <h4 class="card-title">Student Queries</h4>
                   
                  
                
</br>
</br>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Vendor Name</th>
                            <th>Grade</th>
                            <th>Question</th>
                            <!-- <th>Approved Status</th> -->
                            
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
                
                  <td>{{$row->first_name.'  '.    $row->last_name}}</td>
                  <td>{{$row->vendor_name}}</td>
                  <td> {{$row->grade}}</td>
                  <td> {{$row->question}}</td>
                  
                  <!-- <td>@if($row->approved_status == 1) {{'Approved'}} @else {{'Not Approved'}} @endif </td> -->
                  
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td ><a href="{{URL::to('studentqueries/show/'.$row->id) }}"   title="view" class="btn btn-sm btn-primary">View </a></td>
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
          