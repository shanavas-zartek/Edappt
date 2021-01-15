@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student Scrap Book</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Student</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Student Scrap Book</li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Student Scrap Book</h4>
                  </br>
                  </br>
                 <strong>Student Name:</strong>@if(isset($show->first_name))    {{$show->first_name}} {{$show->last_name}}  @endif 
                  </br>
                  </br>
                  <strong>Notes:</strong>@if(isset($show->notes))      {{$show->notes}}  @endif
                  </br>
                  </br>
                  
                  
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer')
          
          
          
