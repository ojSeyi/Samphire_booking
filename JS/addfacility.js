/**
 * Created by OJ Pumping on 09/08/2016.
 */
$('input#addfacility').on('click', function(){
    var facility = $('input#facilityarray').val();
    $.post('ajax/addfacilityproc.php',{facility:facility},function(facilities){
        $('div#facilitydisplay-facilities').innerHTML(facilities);
    });

});