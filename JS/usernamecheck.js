
    $('input#passworda').on('click', function() {
        var x = $('input#usernamea').val();
        if ($.trim(x) != '') {
            $.post('iwekbkabfkhrbfkusernamecheck.php', {x: username}, function (msg) {
                $('div#usernamecheck').text(msg);
            });

        }
    });
