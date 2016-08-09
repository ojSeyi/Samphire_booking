/**
 * Created by OJ Pumping on 09/08/2016.
 */
$('input#addfacility').on('click', function(){
    var facility = $('input#facilityarray').val();
    $.post('ajax/addfacilityproc.php',{facilityarray:facilityarray},function(facilityarray){
        $('div#facili').text(facilityarray);
    });

});