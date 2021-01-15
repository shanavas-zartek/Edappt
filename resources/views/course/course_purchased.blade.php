@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Purchased Courses</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Course</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Course</li>
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
                    <h4 class="card-title">Course List</h4>
                   
                  
              
</br>
</br>
                    <div class="table-responsive">
                      <table class="table table-bordered"  id="dataTbl"> 
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Purchased Date</th>
                            <th>Course</th>
                            <th>Parent</th>
                            <th>Student</th>
                            
                            <th>Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
              <?php $i =1; ?>
              @if(isset($data))
              @foreach ($data as $row)
              <tr>
                <td>{{$i}}</td>
                <td>     @if(!empty($row->created_at))
                  {{Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }} @endif
                  </td>
                  <td>{{$row->course_name}}</td>
               <td>     @if(!empty($row->first_name))
                  {{$row->first_name." ".$row->middle_name." ".$row->last_name." "}} @endif
                  </td>
                  <td>     @if(!empty($row->s_fname))
                  {{$row->s_fname." ".$row->s_mname." ".$row->s_lname}}@endif
                  </td>
                 
                  <td>  @if(!empty($row->course_price))
                  {{$row->course_price}} @endif </td>
                  <td>
                    <a href="{{URL::to('purchased/details/'.$row->id) }}"  data-toggle="tooltip" title="delete" class="btn btn-sm btn-primary">View </a>
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