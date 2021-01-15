@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student Preferences</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Preferences</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Student Preferences </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Student Preferences</h4>
                  </br>
                  </br>
                  
                 <strong>Student Name:</strong>@if(isset($show->first_name))     {{$show->first_name}} {{$show->last_name}}  @endif
                  </br>
                  </br>
                  
                  <strong>Preferences:</strong>@if(isset($show->category_name))      {{$show->category_name}}    @endif
                  </br>
                  </br>
                  <strong>Grade:</strong>  @if(isset($show->grade))     {{$show->grade}}   @endif
                  </br>
                  </br>
                 
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer')
          
          
          
