<?php
    session_start();

    $_SESSION['firstname'] = $user;
    echo "Welcome".$user;