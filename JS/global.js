$('#startdate').datepicker({dateformt: 'dd/mm/yy', minDate: 0 });
$('#enddate').datepicker({dateformt: 'dd/mm/yy', minDate: 0 });

var checkbox = document.getElementById('enddatec');
var delivery_div = document.getElementById('showend');
var showHiddenDiv = function(){
    if(checkbox.checked) {
        delivery_div.style['display'] = 'block';
    } else {
        delivery_div.style['display'] = 'none';
    }
}
checkbox.onclick = showHiddenDiv;
showHiddenDiv();