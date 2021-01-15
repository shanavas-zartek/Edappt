
          
$("#btn_frm_submit").click(function(e){
  e.preventDefault();

  var name = $("#name").val();
  var email =  $("#email").val();
  var phone = $("#phone").val();
  var address1 = $("#address1").val();
  var state = $("#state").val();
  var city = $("#city").val();
   var district = $("#district").val();
  var postcode =  $("#postcode").val();
  var country =  $("#country").val();
  
  if(name ==""){
    $('#company_settings_frm').find('span[name="err_name"]').html("Name is required");
    $("#name").focus();
    return false;
  }
  if(email ==""){
    $('#company_settings_frm').find('span[name="err_email"]').html("Email is required");
    $("#nameemail").focus();
    return false;
  }
  if(phone ==""){
    $('#company_settings_frm').find('span[name="err_phone"]').html("Phone number is required");
    $("#phone").focus();
    return false;
  }
  if(address1 ==""){
    $('#company_settings_frm').find('span[name="err_address1"]').html("Address is required");
    $("#address1").focus();
    return false;
  }
  if(state ==""){
    $('#company_settings_frm').find('span[name="err_state"]').html("State is required");
    $("#state").focus();
    return false;
  }
  if(city ==""){
    $('#company_settings_frm').find('span[name="err_city"]').html("City is required");
    $("#city").focus();
    return false;
  }
   if(district ==""){
    $('#company_settings_frm').find('span[name="err_district"]').html("District is required");
    $("#district").focus();
    return false;
  }
  if(postcode ==""){
    $('#company_settings_frm').find('span[name="err_postcode"]').html("Postcode is required");
    $("#postcode").focus();
    return false;
  }
  if(country ==""){
    $('#company_settings_frm').find('span[name="err_country"]').html("Country is required");
    $("#country").focus();
    return false;
  }


   
  var companyData = $('#company_settings_frm').serialize();

  $.ajax({
    url:"/company/store",
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
    method:"POST",
    data:companyData,
    datatype:'json',
    cache:false,
    processData:false,
    success: function(data) {
      alert(data['message']);
      $('#company_settings_frm')[0].reset();
      result = data['datas'];
      $("#comp_id").val(result['id']);
      $("#name").val(result['name']);
      $("#email").val(result['email']);
      $("#phone").val(result['phone']);
      $("#address1").val(result['address1']);
      $("#address2").val(result['address2']);
      $("#state").val(result['state']);
      $("#city").val(result['city']);
       $("#district").val(result['district']);
      $("#postcode").val(result['pincode']);
      $("#country").val(result['country']);
      $("#contact_person").val(result['contact_person']);
      // if($.isEmptyObject(data.error)){
      //     alert(data.success);
      // }else{
      //     printErrorMsg(data.error);
      // }
  },
    error:function(data){
      alert(data['message']);
      console.log(data);
    }
  });
  function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
  }
  
});

  