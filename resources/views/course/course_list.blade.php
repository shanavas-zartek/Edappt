@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Course Settings</h3>
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
                   
                  
                <a href="{{ route('course.create')}}" class="btn btn-primary btn-rounded btn-fw float-right">ADD</a>
</br>
</br>
                    <div class="table-responsive">
                      <table class="table table-bordered"  id="dataTbl"> 
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Category</th>
                            <th>Age Group</th>
                            <th>Vendor</th>
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
                  <td><a href="{{URL::to('course/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->course_name}}</a></td>
               <td>     @if(!empty($row->category))
                  {{$row->category}} @endif
                  </td>
                  <td>     @if(!empty($row->age_group))
                  {{$row->age_group}} @endif
                  </td>
                  <td>     @if(!empty($row->first_name))
                  {{$row->first_name}} @endif
                  </td>
                  <td>  @if(!empty($row->course_price))
                  {{$row->course_price}} @endif </td>
                  <td>
                    <a href="{{URL::to('course/delete/'.$row->id) }}" onclick="return confirm_click();" data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a>
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