$('#startdate').datepicker({dateformt: 'dd/mm/yy', minDate: 0 });
$('#enddate').datepicker({dateformt: 'dd/mm/yy', minDate: 0 });

$('#enddatec').onclick(document.getElementById('enddate').setAttribute('type', 'date'));