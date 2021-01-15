@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Book A Slot</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Book A Slot</a></li>
                 
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
                    <h4 class="card-title">Book a Slot Requests</h4>       
                  </br>
                  </br>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Topic</th>
                            <th>Requested Date</th>
                            <th>Requested Time</th>
                            <th>Approval Status</th>
                            <th>Status</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                          
              <?php $i =1; ?>
              @if(isset($data))

              @foreach ($data as $row)
              <tr>
                <td>{{$i}}</td>
                <td><a href="{{URL::to('bookslot/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->first_name.'  '.    $row->middle_name.' '.$row->last_name}}</a></td>
               
                  <td>{{$row->topic}}</td>
                  <td>{{$row->requested_date}}</td>
                  <td>{{$row->requested_time}}</td>
                  <td>   @if($row->approval_status == 1) {{'Approved'}} @elseif($row->approval_status == 2) {{'Rejected'}} @else {{'Not Approved'}} @endif </td>
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  
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
          