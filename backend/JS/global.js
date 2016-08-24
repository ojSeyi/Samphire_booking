$('#startdate').datepicker({dateformt: 'dd/mm/yy', minDate: 0 });
$('#enddate').datepicker({dateformt: 'dd/mm/yy', minDate: 0 });


    var add = document.getElementById('ad');
    var del = document.getElementById('de');
    var div1 = document.getElementById('search01');
    var div2 = document.getElementById('search02');

$('#ad').click(function(){
    div1.style['display'] = 'block';
    div2.style['display'] = 'none';
});

$('#de').click(function(){
    div2.style['display'] = 'block';
    div1.style['display'] = 'none';
});



