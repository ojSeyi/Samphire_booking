/**
 * Created by OJ Pumping on 10/08/2016.
 */
$('input#addfacility').onclick(function(){
    var number = 1;
    $.post('creafacilityarray.php', {number:number}, function(data){

    });
});