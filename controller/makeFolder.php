<?php
    require '../helper.php';

    session_start();
    $u = $_SESSION['user']??"";
    $emailpre = explode('@', $u['email'])[0];

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $path = $_POST['path'];
        $folder_name = $_POST['folder-name'];

        // echo $path.'---'.$folder_name;
        // return;

        mkdir('../file/drive/'.$path.'/'.$folder_name);

        $redirecti_path='';
        $path = explode('/', $path);
        foreach ($path as $p) {
            if($p == $emailpre || $p == '') continue;
            
            $redirecti_path.='/'.$p;
        }

        header('Location: '.$BASE_PATH.'/my-drive.php?path='.$redirecti_path);
    }