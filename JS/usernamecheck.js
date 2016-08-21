function validateusername(){
    $('#usernamea').onclick({
            if(x != '')
    {
        $.post('iwekbkabfkhrbfkusernamecheck.php', {x: username}, function (msg) {
            $('div#usernamecheck').text(msg);
        });

    }
});
}