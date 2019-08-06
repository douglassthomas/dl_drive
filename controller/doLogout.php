<?php
    include '../helper.php';
    session_start();

    unset($_SESSION['user']);
    header('Location: '.$BASE_PATH.'');

