<?php
    require '../helper.php';

    session_start();
    $u = $_SESSION['user']??"";
    $emailpre = explode('@', $u['email'])[0];

    function delete_files($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
    
            foreach( $files as $file ){
                delete_files( $file );      
            }
    
            rmdir( $target );
        } elseif(is_file($target)) {
            unlink( $target );  
        }
    }


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $path = $_POST['path'];
        $file_name = $_POST['file-name'];

        $redirecti_path='';
        $path = explode('/', $path);
        foreach ($path as $p) {
            if($p == $emailpre || $p == '') continue;
            
            $redirecti_path.='/'.$p;
        }

        delete_files("../file/drive/$emailpre.$redirecti_path/$file_name");
        
        header('Location: '.$BASE_PATH.'/my-drive.php?path='.$redirecti_path);
    }