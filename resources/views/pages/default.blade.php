
 @include('common.header')
        @include('layouts.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('layouts.header')
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
           
              <h3 class="m-0">Hi, welcome back! </h3>
              </h3>
              
            </div>
            </br>
           <!--    <div class="row" >
              <div class="col-xl-3 col-lg-12 stretch-card grid-margin">
                <div class="row" >
                  <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3" >
                    <div class="card bg-warning">
                      <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                          <div class="color-card">
                            <p class="mb-0 color-card-head">Students</p>
                            <h2 class="text-white"> 10
                            </h2>
                          </div>
                          <i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-warning"></i>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                    <div class="card bg-danger">
                      <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                          <div class="color-card">
                            <p class="mb-0 color-card-head">Parents</p>
                            <h2 class="text-white"> 10
                            </h2>
                          </div>
                          <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                 
                  <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                    <div class="card bg-primary">
                      <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                          <div class="color-card">
                          <a href="{{URL::to('discussionforumdtl/viewlist') }}" data-toggle="tooltip" title="view" ><p class="mb-0 color-card-head">Discussion Forum</p></a>
                            @if(isset($data))
             
                          <h2 class="text-white"> {{$data}} </h2>
                          @endif
                          </div>
                          <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
                        </div>
                       
             
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                    <div class="card bg-success">
                      <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                          <div class="color-card">
                            <p class="mb-0 color-card-head">Queries</p>
                            <h2 class="text-white">10</h2>
                          </div>
                          <i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-success"></i>
                        </div>
                        
                      </div>
                    </div>
                  </div>-->
                </div>
              </div>
             
            </div>
            
       
          @include('common.footer')