
    /**add row for table**/
    function addRow(tableID){

            
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var radio = rowCount - 1;


    var cell1 = row.insertCell(0);
   
    cell1.innerHTML = '<input type="text" name="answer[]" class="form-control answer" id="answer'+rowCount+'"><span class="mandatory_sign" name="answer" required></span>';

    var cell2 = row.insertCell(1);
    cell2.innerHTML = ' <input type="radio" name="right_answer['+radio+']" class="form-control radioBtn" value="1" onchange="checkAnswer(this,'+rowCount+');" id="answer_ids'+rowCount+'">';


    var cell3 = row.insertCell(2);
    cell3.innerHTML = '<button type="button" class="btn-danger closeBtn" onclick="Remove(this,'+rowCount+');"><span aria-hidden="true">&times;</span> </button>';
        
    }  
    function checkAnswer(chk,id) {
    if (chk.value == 1) {
        $('.radioBtn').prop('checked', false);
        $(chk).prop('checked', true);
    }
    }
  /**add delete from table**/
   function Remove(button,idd) {
    var row = $(button).closest("TR");
    var name = $("TD", row).eq(0).html();
      if(row[0].rowIndex == 1){
          alert('You cannot delete the default Answer details.');
      }else {
         //Determine the reference of the Row using the Button.
         
          if (confirm("Do you want to delete?" )) {
              //Get the reference of the Table.
              var table = $("#answerTble")[0];
              //Delete the Table row using it's Index.
              table.deleteRow(row[0].rowIndex);
                  
  }   
      }
  }

  $("#questionForm").on('submit',function(e){
    e.preventDefault();

       // validation start here 
        var question = $("#question").val();
        var status  = $("#status").val();
        var answer = $("#answer").val();
       
        if(question ==""){
          $('#questionForm').find('span[name="question"]').html("Question is required");
          $("#question").focus();
          return false;
        }
       
        if(status == ""){
          $('#questionForm').find('span[name="status"]').html("Status is required");
          $("#status").focus();
          return false;
        }

        $("input[name='answer[]']").each(function() {
            var value = $(this).val();
            if (value == "") {
                $('#questionForm').find('span[name="answer"]').html("Answer is required");
                $('#questionForm').find('input[name="answer"]').focus();
                return false;
            }
        });

       // ajax start here----------------
      // var data = $('#questionForm').serialize();
      // console.log(data);
       var formData = new FormData(this);
      
       $.ajax({
         url:"/questions/store",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
         method:"POST",
         data:formData,
         datatype:'json',
         cache:false,
         contentType: false,
         processData:false,
         success:function(response){
          printQustionData(response);
         },
         error:function(data){
           alert(data['message']);
           console.log(data);
         }
       });

  });

 function deleteQstn(qstnid){
   var hdr_id  = $("#hdr_id").val();
   console.log('queid'+qstnid);
   console.log('hdrid'+hdr_id);

    $.ajax({
    url:"/questions/delete",
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
    method:"POST",
    data: { qstnid:qstnid, hdr_id:hdr_id },
    datatype:'json',
    success:function(response){
      printQustionData(response);
      alert("Question and answes deleted successfully");
    },
    error:function(data){
     alert("Failed to delete question details")
      console.log(data);
    }
  });
  }

function printQustionData(response){
  $("#qsansTbl").empty();

  var preqs_id ='';
  var right_Answer = '';
  var i =1;
  var question = '';
  $.each(response, function(key,value) {
    clearData();
    if(value.is_correct_answer == 1){
      right_Answer = 'YES';
    }else{
      right_Answer = 'NO';
    }
    var deletebtn = '';
    if(value.question_id != preqs_id){
      deletebtn = '<td> <a onclick="deleteQstn('+value.question_id+')"  href="#" data-toggle="tooltip" title="delete" class="btn btn-sm btn-danger">Delete </a></td>';
    }else{
      deletebtn = '<td></td>';
    }
        $('#qsansTbl').append('<tr><td>'+ (value.question_id != preqs_id ? i : '')+'</td><td>'+
        (value.question_id != preqs_id ?value.question : question )+'</td><td>'+value.answer_option+'</td><td>'+right_Answer+'</td>'+deletebtn+'</tr>');
        if(value.question_id != preqs_id){
          i++;
        }
        preqs_id = value.question_id; 
      });
}

function clearData(){
  $("#question").val('');
  $("#description").val('');
   $("#quest_file").val('');
  $("#status").val('');
  $(".answer").val('');
  $('.radioBtn').prop('checked', false);
}