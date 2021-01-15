@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student Repository</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Student</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Student Repository</li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title">Student Repository</h4>
                  <form method="POST" id="form1" enctype="multipart/form-data" >
                    @csrf  
                   
                    <div class="form-group">
                      <label for="Name">Student Name</label>
                      <input readonly type="text" class="form-control" @if(isset($data->first_name)) value="{{$data->first_name." ".$data->middle_name." ".$data->last_name}}" @endif readonly  />
                     
                    </div>
                    <div class="form-group">
                      <label for="Topic">Folder Name</label>
                     <input type="text" class="form-control" @if(isset($data->foldername)) value="{{$data->foldername }}"" @endif readonly> 
                    </div>
                    
                    
                    <div class="form-group">
                    <label for="Status">Status </label>
                    <select name="status" class="form-control">
                    
                    <option @if(isset($data->is_active) && ($data->is_active == 1)) selected @endif value="1">Active</option>
                    <option @if(isset($data->is_active) && ($data->is_active == 0) ) selected @endif value="0">Inactive</option>
                    </select>
                    </div>
                   
                  </form>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTbl">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>File Name</th>
                            <th>File Title</th>
                            <th>File Type</th>
                            <th>File </th>
                           
                            
                           
                          </tr>
                        </thead>
                        <tbody>
                          
              <?php $i =1; ?>
              @if(isset($show))

              @foreach ($show as $row)
              <tr>
                <td>{{$i}}</td>
              
                  <td> <a href="{{ url('uploads/StudentRepository/'.$row->file_name) }}" >{{$row->file_name}}</a></td>
                  <td> {{$row->file_title}}</td>
                  
                  <td> {{$row->file_type}}</td>
                  @if($row->file_type=='image')
                      
                      
                  <td><img src="{{ url('uploads/StudentRepository/'.$row->file_name) }}" ></td>
                  @else
                  <td> <embed  src="{{ url('uploads/StudentRepository/'.$row->file_name) }}"  height="150px" width="100%" alt="{{$row->file_name}}"></td>
                 
                  @endif
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
         
