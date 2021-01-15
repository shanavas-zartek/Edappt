@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Subscription Plans</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Subscriptions</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Plans</li>
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
                    <h4 class="card-title">Plans</h4>
                   
                  
                <a href="{{ route('subscription.create')}}" class="btn btn-primary btn-rounded btn-fw float-right">ADD</a>
</br>
</br>
                    <div class="table-responsive">
                      <table class="table table-bordered"  id="dataTbl"> 
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Plan</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Amount</th>
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
                  <td><a href="{{URL::to('subscription/edit/'.$row->id) }}" data-toggle="tooltip" title="pos">{{$row->package_name}}</a></td>
                  <td> 
                @if(!empty($row->start_date))
                  {{Carbon\Carbon::parse($row->start_date)->format('d-m-Y')}} @endif
               </td>
                  <td>     @if(!empty($row->end_date))
                  {{Carbon\Carbon::parse($row->end_date)->format('d-m-Y')}} @endif
                  </td>
                  <td> {{$row->amount}}</td>
                  <td>   @if($row->is_active == 1) {{'Active'}} @else {{'Inactive'}} @endif </td>
                  <td><a href="{{URL::to('subscription/delete/'.$row->id) }}" onclick="return confirm_click();"  data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a></td>
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