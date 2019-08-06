<?php
    require '../helper.php';

    ini_set('upload_max_filesize', '2000M');
    ini_set('post_max_size', '2000M');

    session_start();
    $u = $_SESSION['user']??"";
    $emailpre = explode('@', $u['email'])[0];

    

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $path = $_POST['path'];
        $name = $_FILES['fileUpload']['name'];
        
        move_uploaded_file($_FILES['fileUpload']['tmp_name'], '../file/drive/'.$path.'/'.$name);
    
        $redirecti_path='';
        $path = explode('/', $path);
        foreach ($path as $p) {
            if($p == $emailpre || $p == '') continue;
            
            $redirecti_path.='/'.$p;
        }

        header('Location: '.$BASE_PATH.'/my-drive.php?path='.$redirecti_path);
        
    }