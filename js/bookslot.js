
$("#btn_frm_submit").click(function(e){
    e.preventDefault();
  // check booking slot is vailable 
  var start_date = $("#start_date").val();
  var start_time = $("#start_time").val();
  var end_time = $("#end_time").val();
  var book_slot_id = $("#book_slot_id").val();
  $.ajax({
    url:"/bookslot/checkslot",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    type: 'post',
    data:{start_date:start_date,start_time:start_time,end_time:end_time,book_slot_id:book_slot_id},
    async: true,
    dataType: "json",
    success:function(data){
      if(data['count'] > 0){
        alert("Selected date and time is already booked");
        return false;
      }else{
        $( "#book_slot_frm" ).submit();
        
      }
    },
    error:function(){
      alert(data);
    }
  });
});