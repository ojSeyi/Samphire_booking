/**
 * Created by OJ Pumping on 09/08/2016.
 */
$('input#facilityarray-addfacility').on('click', function(){
    var facility = $('input#facilityarray').val();
    $.post('addfacilityproc.php',{addfacility:addfacility},function(facilityarray){
        facilities = facilityarray;

    });

});