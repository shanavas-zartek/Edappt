@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student Queries</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Student</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Student Queries </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Student Queries</h4>
                  </br>
                  </br>
                 <strong>Student Name:</strong>    {{$show->first_name}} {{$show->last_name}}
                  </br>
                  </br>
                  <strong>Vendor Name:</strong>     {{$show->vendor_name}}
                  </br>
                  </br>
                  <strong>Question:</strong>       {{$show->question}}
                  </br>
                  </br>
                  <!-- <strong>Query Status:</strong>       @if($show->approved_status == 1) {{'Approved'}} @else {{'Not Approved'}} @endif 
                  </br>
                  </br>
                  <strong>Query Approved on:</strong>       @if($show->approved_status == 1) {{$show->approved_on}}  @endif  -->
                  </br>
                  </br>
                  
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer')
          
          
          
