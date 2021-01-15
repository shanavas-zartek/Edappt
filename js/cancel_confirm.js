 $(document).ready(function(){ 
           
           
            $("form :input").change(function() {
               $(this).closest('form').data('changed', true);
            });
            $("#cancelBtn").click(function(){
              var url =$("#hdn_url").val();
             
              if($(this).closest('form').data('changed')) {
                if (confirm('Are you sure you want to leave this page? If you leave before saving, your changes will be lost.')) {
                  window.location.href = url;

                 } else {
                    // Do nothing!
                     console.log('Thing was not saved to the database.');
                  }
            } 
            else{
              window.location.href = url;

            }
            e.preventDefault();
   
 
          });
});