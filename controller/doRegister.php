<?php
    require "User.php";
    include "../helper.php";
    session_start();
    $_SESSION['error-email'] = '';
    $_SESSION['error-password'] = '';

    function checkAlphaNum($word){
        $upper = FALSE;
        $lower = FALSE;
        $numeric = FALSE;

        $split_word = str_split($word);

        foreach($split_word as $w){
            if(ctype_lower($w)) $lower=TRUE;
            if(ctype_upper($w)) $upper=TRUE;
            if(ctype_digit($w)) $numeric=TRUE;
        }

        return $upper&&$lower&&$numeric?TRUE:FALSE;
        
    }
    
    $file = fopen("../file/users.txt", "a") or die("error");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $email = strpos($_POST['email'], '@dmail.com')?$_POST['email']:$_POST['email']."@dmail.com";
        $password = $_POST['password'];
        $name = $_POST['name'];

        foreach($users as $s){
            $email_pre = explode('@',$s['email'])[0];
            if(($s['email'] == $email || $email_pre == $email)){ 
                $_SESSION['error-email'] = 'The email address has already been used';
                header('Location: '.$BASE_PATH.'/register.php');
                return;
            }
        }
        if(!checkAlphaNum($password)){
            $_SESSION['error-password'] = 'Password must contains uppercase-lowercase-numeric letter';
            header('Location: '.$BASE_PATH.'/register.php');
            return;
        }

        
        $data = "$email#$password#$name\n";
        fwrite($file, $data);
        fclose($file);

        $email_pre = explode('@',$email)[0];
        if(file_exists("../file/drive")){
            mkdir("../file/drive/$email_pre");
        }else{
            mkdir("../file/drive/");
            mkdir("../file/drive/$email_pre");
        }

        header('Location: '.$BASE_PATH."/login.php?");
        foreach($users as $s){
            $email_pre = explode('@',$s['email'])[0];
            if(($s['email'] == $email || $email_pre == $email) && $s['password'] == $password){ 
                $_SESSION['user'] = array("email"=>$s['email'], "name"=>$s['name']);
                
                return;
            }
        }
        
    }