function onload() {
    var input = document.getElementsByName("startdate");
    var today = new Date();
    // Set month and day to string to add leading 0
    var day = new String(today.getDate());
    var mon = new String(today.getMonth()+1); //January is 0!
    var yr = today.getFullYear();

    if(day.length < 2) { day = "0" + day; }
    if(mon.length < 2) { mon = "0" + mon; }

    var date = new String( yr + '-' + mon + '-' + day );

    input.disabled = false;
    input.setAttribute('min', date);
}
document.addEventListener("load", onload, false);


