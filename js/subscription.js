$(document).ready(function(){ 
    var today = new Date().toISOString().split('T')[0];    
    document.getElementsByName("start_date")[0].setAttribute('min', today);
    document.getElementsByName("end_date")[0].setAttribute('min', today);
});

$("#end_date").change(function () {
    date_range_validate();
});

$("#start_date").change(function () {
    var startDate = document.getElementById("start_date").value;
    $("#end_date").val(startDate);
});

function date_range_validate()
{
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;

    if ((Date.parse(endDate) <= Date.parse(startDate))) {
        $("#end_date").val("");
        $('#subscription_frm').find('span[name="date_range_valid"]').html("End date should be greater than Start date");                
        $("#end_date").focus();
    }

}
