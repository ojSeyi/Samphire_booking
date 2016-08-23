$('#startdate').datepicker({dateformt: 'dd/mm/yy', minDate: 0 }).val('');
$('#enddate').datepicker({dateformt: 'dd/mm/yy', minDate: 0,  }).val('');

var checkbox = document.getElementById('enddatec');
var delivery_div = document.getElementById('showend');
var enddate = document.getElementById('enddate');
var showHiddenDiv = function(){
    if(checkbox.checked) {
        delivery_div.style['display'] = 'block';
        enddate.required = true;
    } else {
        delivery_div.style['display'] = 'none';
        enddate.required = false;
    }
}
checkbox.onclick = showHiddenDiv;
showHiddenDiv();

function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match.
        //Set the color to the good color and inform
        //the user that they have entered the correct password
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}