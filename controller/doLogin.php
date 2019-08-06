<?php
    include "User.php";
    include "../helper.php";
    session_start();
    $_SESSION['error-msg'] = '';


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        foreach($users as $s){
            $email_pre = explode('@',$s['email'])[0];
            if(($s['email'] == $email || $email_pre == $email) && $s['password'] == $password){ 
                $_SESSION['user'] = array("email"=>$s['email'], "name"=>$s['name']);
                header('Location: '.$BASE_PATH."/my-drive.php");
                return;
            }
        }

        $_SESSION['error-msg'] = 'Invalid email or password';
        header('Location: '.$BASE_PATH.'/login.php');
    }