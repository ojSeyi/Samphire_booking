/**
 * Created by OJ Pumping on 10/08/2016.
 */
$('input#addfacility').onclick(function(){
    var number = 1;
    $.post('ajax/facilitycount.php', {number:number}, function(data){

    });
});