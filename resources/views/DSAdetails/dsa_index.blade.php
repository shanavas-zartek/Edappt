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
                  <li class="breadcrumb-item active" aria-current="page"> DSA Details</li>
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
                    <h4 class="card-title">DSA Details</h4>
                   
                  
                <a href="{{ route('DSAdetails.create')}}" class="btn btn-primary btn-rounded btn-fw float-right">ADD</a>
</br>
</br>
<div class="table-responsive">
                      <table  class="table table-bordered table-hover" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th> Name</th>
                            
                            <th>Address</th>
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
              
                  <td><a href="{{URL::to('DSAdetails/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->first_name.'  '.    $row->last_name}}</a></td>
                  
                  <td> {{$row->address}}</td>
                  <td> {{$row->contact_no}}</td>
                  <td> {{$row->email}}</td>
                  
                 
                 
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td><a href="{{URL::to('DSAdetails/delete/'.$row->id) }}" onclick="return confirm_click();"  data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a>
                  <a href="{{URL::to('DSAdetails/view/'.$row->id) }}" data-toggle="tooltip" title="view" class="btn btn-sm btn-primary">View</a>
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