/**
 * Created by OJ Pumping on 08/08/2016.
 */

var input = document.getElementById("startdate");
var today = new Date();
var day = today.getDate();
// Set month to string to add leading 0
var mon = new String(today.getMonth()+1); //January is 0!
var yr = today.getFullYear();

if(mon.length < 2) { mon = "0" + mon; }

var date = new String( day + '-' + mon + '-' + yr );

input.disabled = false;
input.setAttribute('min', date);
$(startdate).val(date);

