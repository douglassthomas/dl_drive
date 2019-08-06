<?php
    $users = [];

    $users = array();

    $file = fopen("../file/users.txt", "r") or die("error");
    $users_data = fread($file, filesize("../file/users.txt"));
    $user_data = explode("\n", $users_data);
    
    foreach($user_data as $s){
        $each_delimit = explode("#", $s);
        $each = array(
            "email"=>$each_delimit[0],
            "password"=>$each_delimit[1]??"",
            "name"=>$each_delimit[2]??""
        );
        
        array_push($users, $each);
    }

    fclose($file);
    

    