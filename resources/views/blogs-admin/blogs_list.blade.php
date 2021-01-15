@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Admin Blogs</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Admin</li>
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
                    <h4 class="card-title">Blogs</h4>
                   
                  
                <a href="{{ route('adminblogs.create')}}" class="btn btn-primary btn-rounded btn-fw float-right">ADD</a>
</br>
</br>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Publish From</th>
                            <th>Publish To</th>
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
                  <td><a href="{{URL::to('adminblogs/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->blog_title}}</a></td>
                  <td> 
                @if(!empty($row->published_from))
                  {{Carbon\Carbon::parse($row->published_from)->format('d-m-Y')}} @endif
               </td>
                  <td>     @if(!empty($row->published_to))
                  {{Carbon\Carbon::parse($row->published_to)->format('d-m-Y')}} @endif
                  </td>
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td><a href="{{URL::to('adminblogs/delete/'.$row->id) }}" onclick="return confirm_click();" data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a></td>
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