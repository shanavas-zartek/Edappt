 @include('common.header')
@include('layouts.sidebar')
@include('layouts.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Create Questions</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Activities</a></li>
                  <li class="breadcrumb-item"> Details</li>
                  <li class="breadcrumb-item active" aria-current="page"> Questions</li>
                </ol>
              </nav>
            </div>
            <div class="flash-message">
              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))

                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
              @endforeach
        </div> <!-- end .flash-message -->
            <div class="col-12 grid-margin">
              <div class="card col-12">
                <div class="card-body">
                  <h4 class="card-title">Question Creation</h4>
                  <form method="POST" id="questionForm" action="javascript:void(0)" >
                    @csrf  
                    
                    <input type="hidden" class="form-control" @if(isset($hdr_id)) value="{{$hdr_id}}" @endif name="hdr_id" id="hdr_id" />
              
                    <div class="row">
                      <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Question <span class="mandatory_sign">*</span></label>
                      <input type="text" class="form-control" @if(isset($edit->question)) value="{{$edit->question}}" @endif name="question" id="question" placeholder="Question" />
                      <span class="mandatory_sign" name="question"></span>
                    </div>
                </div>
                <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                         <textarea name="description" class="form-control" id="description"> @if(isset($edit->description)) {{$edit->description}} @endif</textarea>
                        </div>
                  </div>
               </div>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Image/Audio/Video Upload </label>
                      
                      <input type="file" id="quest_file" name="quest_file" class="file-upload-default" />
                      <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image/Audio/Video"  id="quest_file" name="quest_file" />
                      <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button"> Upload </button>
                     </span>
                   </div>
                    </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Status <span class="mandatory_sign">*</span></label>
                      <select name="status" class="form-control" id="status">
                      <option value="">Select</option>
                      <option @if(isset($edit->is_active) && ($edit->is_active == 1)){ selected }@endif value="1">Active</option>
                      <option @if(isset($edit->is_active) && ($edit->is_active == 0) ){selected} @endif value="0">Inactive</option>
                      </select>
                      <span class="mandatory_sign" name="status"></span>
                      </div>
                      </div>
                     </div>
                   
                     <p class="card-description">Answer Options</p>
                     <div class="row">
                      <div class="col-md-12">
                        <table id="answerTble" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                          <thead>
                              <th>Answer Option</th>
                              <th>Is Right Answer</th>
                               <th>Remove</th>
                          </thead>
                          <tbody>
                            <td> <input type="text" name="answer[]" id="answer1" class="form-control answer"  >
                              <span class="mandatory_sign" name="answer"></span>
                            </td>
                            <td><input type="radio" name="right_answer[0]" class="form-control radioBtn" value="1" id="answer_ids1" onchange="checkAnswer(this,1)"> </td>
                           
                            <td><button type="button" class="btn-danger closeBtn" onclick="Remove(this,0);">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </td>

                          </tbody>
                        </table>
                        <span class="add_btn">  <input type="button" class="btn-success float-right plusBtn" id="add" onclick="addRow('answerTble')" value="+">    </span>
                        </div>
                     </div>
                                       
                     <div class="row">
                      <div class="col-md-6 ">
                        <div class="anscontents"></div>
                        </div>
                        
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="rgtAnswer"></div>
                          </div>
                          </div>
                          <!-- <div class="col-md-3">
                            <div class="removecontents"></div>
                          </div> -->
                        </div>


                    <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                    <input type="hidden"   value="{{ route('details.index')}}"   id="hdn_url" name="hdn_url"  />
                    <button class="btn btn-light" type="button" id="cancelBtn"  >Cancel</button>
                  </form>

                  <div class="row">
                    <div class="col-md-12">
                      <!-- <div class="Qustn">1/Who are you</div>
                      <div class="Ans">1.ABC 2. QE</div> -->
                      <table class="table table-bordered table-hover list-table-sec">
                        <thead class="thead-dark">
                          <tr>
                            <td>Sl No</td>
                            <td>Question</td>
                            <td>Answer Options</td>
                            <td>Answer</td>
                            <td>Action</td>
                          </tr>
                        </thead>
                        <tbody id="qsansTbl">
                          @if(isset($quesAnsData))
                          <?php $i =1; $preqs_id =''; ?>
                              @foreach($quesAnsData as $data)
                     <tr>
                     <td> @if($data->question_id != $preqs_id) {{$i}} @endif</td>
                       <td> @if($data->question_id != $preqs_id)<b> {{ $data->question}}</b> 
                        <?php $i++; ?> @endif
                        </td>
                       <td>{{ $data->answer_option}}</td>
                       <td>@if($data->is_correct_answer == 1){{'YES' }} @else {{'NO'}} @endif</td>
                       <td> @if($data->question_id != $preqs_id) <a onclick="deleteQstn( {{ $data->question_id}} )"
                       href="#" data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a> @endif</td>
                       </tr>
                      <?php  $preqs_id = $data->question_id; ?>
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
          </div>
         
          @include('common.footer') 
        
          <script src="{{ asset('js/questions.js') }}"></script>
          <script src="{{ asset('js/cancel_confirm.js') }}"></script> 
