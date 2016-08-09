/**
 * Created by OJ Pumping on 09/08/2016.
 */
$('input#facilityarray-addfacility').on('click', function(){
    $.post('addfacilityproc.php',{facilityarray:facilityarray},function(facilityarray){
        $('#facili-facilityarray').text(facilityarray);

    });

});