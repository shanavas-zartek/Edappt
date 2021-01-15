@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Study Group</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Study Groups</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Study Group Request</li>
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
                    <h4 class="card-title">Study Group Request</h4>       
                  </br>
                  </br>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Description</th>
                            
                            
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
                  <td>{{$row->message}}</td>
                  
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td > <a href="{{URL::to('studygrouprequest/create/'.$row->id) }}"  title="add" class="btn btn-sm btn-success">Create Group </a></td>
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
          