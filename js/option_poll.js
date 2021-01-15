
    /**add row for table**/
    function addRow(tableID){

            
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var radio = rowCount - 1;


    var cell1 = row.insertCell(0);
   
    cell1.innerHTML = '<input type="text" name="answer[]" required class="form-control answer" id="answer'+rowCount+'"><span class="mandatory_sign" name="answer" required></span>';

    var cell2 = row.insertCell(1);
    cell2.innerHTML = '<button type="button" class="btn-danger closeBtn" onclick="Remove(this,'+rowCount+');"><span aria-hidden="true">&times;</span> </button>';
        
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

  $("#optionpollForm").on('submit',function(e){
    e.preventDefault();
    var isValid = true;

       // validation start here 
       var poll_type = $("#poll_type").val();
        var question = $("#question").val();
        var status  = $("#status").val();
        var answer = $("#answer").val();
       
        if(poll_type ==""){
          $('#optionpollForm').find('span[name="poll_type"]').html("Option poll type is required");
          $("#poll_type").focus();
          isValid = false;
        }else{
          $('#optionpollForm').find('span[name="poll_type"]').hide();
        }
        if(question ==""){
          $('#optionpollForm').find('span[name="question"]').html("Question is required");
          $("#question").focus();
          isValid = false;
        }else{
          $('#optionpollForm').find('span[name="question"]').hide();
        }
        if(status == ""){
          $('#optionpollForm').find('span[name="status"]').html("Status is required");
          $("#status").focus();
          isValid = false;
        }else{
          $('#optionpollForm').find('span[name="status"]').hide();
        }

        $(".answer").each(function() {
            var value = $(this).val();
            if (value == "") {
                $('#optionpollForm').find('span[name="answer"]').html("Answer is required");
                $('#optionpollForm').find('input[name="answer"]').focus();
                isValid = false;
            }else{
              $('#optionpollForm').find('span[name="answer"]').hide();
            }
        });

        if (isValid == false){
            e.preventDefault();
        }
         else
         {
        //  ajax start here----------------
          var data = $('#optionpollForm').serialize();
          console.log(data);
         
          $.ajax({
            url:"/optionpoll/store",
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            method:"POST",
            data:data,
            datatype:'json',
            cache:false,
            processData:false,
            success:function(response){
             alert(response['Message']);
             if(response['status'] == 1){
              clearData();
             }
             
            },
            error:function(data){
              alert(data['Message']);
              console.log(data);
            }
          });
         }
        
       

  });


function clearData(){
  $("#poll_type").val('');
  $("#question").val('');
  $("#description").val('');
  $("#status").val('');
  $(".answer").val('');

}