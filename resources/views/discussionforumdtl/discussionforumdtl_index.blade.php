@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Discussion Forum Reply</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Discussion Forum</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Discussion Forum Reply</li>
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
                    <h4 class="card-title">Discussion Forum Reply</h4>
                   
                  
               
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Topic</th>
                            <th>Reply</th>
                            <th>Like</th>
                            <th>Approved Status</th>
                           
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
                  <td><a href="{{URL::to('discussionforumdtl/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->first_name.'  '.    $row->last_name}}</a></td>
                  <td> {{$row->topic}}</td>
                  <td> {{substr($row->reply,0,10)}}</td>
                  <td>  @if($row->likes == 1) {{'Yes'}} @else {{'No'}} @endif</td>
                  <td>  @if($row->approved_status == 1) {{'Approved'}} @elseif($row->approved_status == 2) {{'Rejected'}} @else {{'Not Approved'}} @endif </td>
                  
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td><a href="{{URL::to('discussionforumdtl/delete/'.$row->id) }}" onclick="return confirm_click();" data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a>
                  
                </td>
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
          <script src="{{ asset('js/confirmation.js') }}"></script>