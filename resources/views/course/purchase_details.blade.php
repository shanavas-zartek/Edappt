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
                    <h4 class="card-title">Course Purcase Details</h4>
                   
                  
               
</br>
</br>
<div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-primary">  @if(!empty($data->first_name))
                  {{$data->first_name." ".$data->middle_name." ".$data->last_name." "}} @endif</h4>
                    <p class="card-description">   @if(!empty($data->address))
                  {{$data->address}} @endif </p>
                    <p>
                      <u>@if(!empty($data->contact_no))
                  {{$data->contact_no}} @endif </u>
                 <br> <u>@if(!empty($data->email))
                  {{$data->email}} @endif </u>
                    </p>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title text-success">Course Details</h4>
                    <p class="card-description">Course: @if(!empty($data->course_name))
                  {{$data->course_name}} @endif
                    </p>
                    <p>@if(!empty($data->category))
                    Catgory :  {{$data->category}} @endif </p>
                    <p>
                      <u>Price: @if(!empty($data->course_price))
                  {{$data->course_price}} @endif </u>
                 <br> <u> Purchased on: @if(!empty($data->created_at))
                  {{Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}} @endif </u>
                  <br>
                    </p>

                    <p class="text-lowercase"> @if(!empty($data->description))
                  {{$data->description}} @endif </p>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title text-warning">Student Detais</h4>
                    <p class="card-description">  @if(!empty($data->s_fname))
                  {{$data->s_fname." ".$data->s_mname." ".$data->s_lname}}@endif
                    </p>
                    <p class="text-uppercase"> Agegroup: {{$data->age_group}} </p>
                  </div>
                </div>
              </div>
                  </div>
                </div>
              </div>
              </div>
          </div>
          @include('common.footer')
          <script src="{{ asset('js/confirmation.js') }}"></script>