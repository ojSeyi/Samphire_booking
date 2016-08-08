/**
 * Created by OJ Pumping on 08/08/2016.
 */

function setDate(date){
    z=$(date).val();

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd}
    if(mm<10){mm='0'+mm}
    today = yyyy+'-'+mm+'-'+dd;

    $(date).val(today);
}