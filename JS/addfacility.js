/**
 * Created by OJ Pumping on 09/08/2016.
 */
$('input#addfacility').on('click', function(){
    var facility = $('input#facilityarray').val();
    $.post('addfacilityproc.php',{facilityarray:facilityarray},function(facilityarray){
        $('#facili').text(facilityarray);
    });

});