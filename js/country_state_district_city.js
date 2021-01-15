$(document).ready(function(){ 
           
           
          $('#country').change(function(){
          var countryID = $(this).val();   
          
          if(countryID){
           $.ajax({
           type:"GET",
           url : '/location/get-state-list/' +countryID,
           
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option>--- Select  ---</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#district").empty();
        $("#city").empty();
    }      
   });
    $('#state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
           type:"GET",
           url : '/location/get-district-list/' +stateID,
         
           success:function(res){               
            if(res){
                $("#district").empty();
                $("#district").append('<option>--- Select  ---</option>');
                $.each(res,function(key,value){
                    $("#district").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#district").empty();
               
            }
           }
        });
    }else{
        $("#district").empty();
         $("#city").empty();
    }
        
   });
   $('#district').on('change',function(){
    var districtID = $(this).val();    
    if(districtID){
        $.ajax({
           type:"GET",
           url : '/location/get-city-list/' +districtID,
         
           success:function(res){               
            if(res){
                $("#city").empty();
                $("#city").append('<option>--- Select  ---</option>');
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });
  });