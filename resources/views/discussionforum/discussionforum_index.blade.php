@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Discussion Forum</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Discussion Forum</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Discussion Forum</li>
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
                    <h4 class="card-title">Discussion Forum</h4>
                   
                  
                <a href="{{ route('discussionforum.create')}}" class="btn btn-primary btn-rounded btn-fw float-right">ADD</a>
</br>
</br>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Topic</th>
                            <th> Category</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Image</th>
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
                  <td><a href="{{URL::to('discussionforum/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->topic}}</a></td>
                  <td> {{$row->category_name}}</td>
                  <td> {{$row->description}}</td>
                  <td> {{Carbon\Carbon::parse($row->start_date)->format('d-m-Y')}}</td>
                  <td> {{Carbon\Carbon::parse($row->end_date)->format('d-m-Y')}}</td>
                  <td> <img src="{{ url('uploads/DiscussionForum/'.$row->image) }}"  height="100" width="100"></td>
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td><a href="{{URL::to('discussionforum/delete/'.$row->id) }}" onclick="return confirm_click();"  data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a>
                  
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