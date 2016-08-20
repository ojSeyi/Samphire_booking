function validateusername(){
    var x = document.forms["registration"]["username"].value;
    if(x != ''){
        $.post('iwekbkabfkhrbfkusernamecheck.php', {x:username}, function(msg){
            $('div#usernamecheck').text(msg);
        });

    }
}