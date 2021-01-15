@include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Edit Opinion Polls </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"> Opinion Polls</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Opinion Polls </li>
                </ol>
              </nav>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="col-12 grid-margin">
              <div class="card col-9">
                <div class="card-body">
                  <h4 class="card-title"> Opinion Polls</h4>
                  <form method="POST" id="form1" action="{{ route('optionpoll.approve_requests')}}">
                 
                   
                    @csrf  
                    <input type="hidden" id="question_id" name="question_id" class="form-control" value="{{$edit->id}}">        
                    <div class="form-group">
                      <label for="Type"> Opinion Polls Type<span class="mandatory_sign">*</span></label>
                     <select name="poll_type" id="poll_type" class="form-control" disabled>
                     <option value="">Select</option>
                     @if(isset($poll_type))
                      @foreach($poll_type as $type)
                      <option @if(($edit->poll_type_id==$type->id)) selected @endif value="{{$type->id}}">{{$type->type}}</option>
                      @endforeach
                     @endif
                     </select>
                     <span class="mandatory_sign" name="poll_type"></span>
                    </div>

                    <div class="form-group">
                      <label for="Question">Question</label>
                     <input type="text" readonly id="question" name="question" class="form-control" value="{{$edit->question}}">
                     <span class="mandatory_sign" name="question"></span>
                    </div>
                    
                                       
                    <p class="card-description">Answer Options</p>
                     <div class="row">
                      <div class="col-md-12">
                        <table id="answerTble" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                          <thead>
                              <th>Answer Option</th>
                            
                          </thead>
                          <tbody>
                          @if(empty($option_answers))
                          <tr>
                            <td> <input type="text" name="answer[]" id="answer1" class="form-control answer" readonly >
                              <span class="mandatory_sign" name="answer"></span>
                            </td>
                      
                          </tr>
                     
                        @else 
                     <?php $i = 1; ?>
@foreach($option_answers as $row)

  <tr>
                            <td> <input type="text" name="answer[]" id="answer<?= $i  ?>" readonly class="form-control answer" value="  {{$row->answer }} " >
                              <span class="mandatory_sign" name="answer"></span>
                            </td>                 
                            
                          </tr>
                          <?php $i++ ?>
                        @endforeach
                     
                           @endif
                          </tbody>
                        </table>
                      
                        </div>
                     </div><br>
                     <div class="form-group">
                      <label for="Status">Status<span class="mandatory_sign">*</span></label>
                        <select name="status" class="form-control" id="status" >
                        <option value="">Select</option>
                        <option @if(isset($edit->is_active) && ($edit->is_active == 1)) selected @endif value="1"  >Active</option>
                        <option @if(isset($edit->is_active) && ($edit->is_active == 0)) selected @endif value="0" >Inactive </option>
                       </select> <span class="mandatory_sign" name="status"></span>
                    </div>
                     <div class="form-group">
                      <label for="">Approval Status </label>
                      <select name="approval_status" class="form-control">
                      <option value="">Select</option>
                      <option @if($edit->approval_status == 1)selected  @endif value="1">Approved</option>
                      <option @if($edit->approval_status == 2) selected @endif value="2" >Rejected</option>
                      <option @if($edit->approval_status == 0) selected @endif value="0" >Not Approved</option>
                      </select>
                      </div>  

                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('optionpoll.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>
                </div>
              </div>
            </div>
              </div>
          </div>
         
          @include('common.footer') 
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
