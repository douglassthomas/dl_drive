<?php
    session_start();
    $mode = 1;
    $err_email = $_SESSION['error-email']??'';
    $err_password = $_SESSION['error-password']??'';

    if(isset($_POST['mode'])){
        $mode = $_POST['mode'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doodle Drive: Register</title>
    <link rel='stylesheet' href='style/home.css'/>
    <link rel='stylesheet' href='style/login.css'/>
    <link rel="icon" href="assets/logo.png">
</head>
<body>


    <div class='container-login'>
    <form action='controller/doRegister.php' method='POST'>
        <div class='login-box'>
            <img src='assets/logo-company.png' style='height:20px; margin-top:45px'/>
            <span class='title-text'>Login</span>
            <span class='sub-title'>Lanjutkan ke doodle drive</span>

            <input type='hidden' name='mode' value='2'/>
            <input required name='email' id='email' class='text-material' type='text' placeholder="email" autofocus/>
            <p class='error-msg'><?= $err_email ?></p>
            <input required name='password' id='password' class='text-material' type='password' placeholder="password" style='margin-top:20px'/>
            <p class='error-msg'><?= $err_password ?></p>
            <input required name='name' id='name' class='text-material' type='text' placeholder="name" style='margin-top:20px'/>


                <span class='mini-container'>
                    <a href='login.php' class='register-text no-decoration'>Masuk</a>
                    <button type='submit' id='berikutnya' class='btn-biru'>Daftar</button>
                </span>
            



        </div>
    </form>
    </div>



</body>
</html>