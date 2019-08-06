<?php
    session_start();
    $mode = 1;
    $err_msg = $_SESSION['error-msg']??'';

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
    <title>Doodle Drive: Login</title>
    <link rel='stylesheet' href='style/home.css'/>
    <link rel='stylesheet' href='style/login.css'/>
    <link rel="icon" href="assets/logo.png">
</head>
<body>


    <div class='container-login'>
    <form action='<?= $mode==1?'':'controller/doLogin.php' ?>' method='POST'>
        <div class='login-box'>
            <img src='assets/logo-company.png' style='height:20px; margin-top:45px'/>
            <span class='title-text'>Login</span>
            <span class='sub-title'>Lanjutkan ke doodle drive</span>

            <?php if($mode==1) {?> <input type='hidden' name='mode' value='2'/>
                <input required name='email' id='email' class='text-material' type='text' autofocus/>
                <label for='email' class='label-text'>Email atau ponsel</label>
                <p class='error-msg'><?= $err_msg ?></p>
            <?php } ?>
            
            <?php  if($mode==2) {?> 
                <input name='email' id='email' class='text-material' type='hidden' value='<?= $_POST['email'] ?>'/>
                <input required name='password' id='password' class='text-material' type='password' autofocus/>
                <label for='email' class='label-text' style='margin-right:290px'>Password</label> 
            <?php } ?>

                <span class='himbauan'>Bukan komputer Anda? Gunakan Private Window untuk login.</span>

                <span class='mini-container'>
                    <a href='register.php' class='register-text no-decoration'>Buat akun</a>
                    <button type='submit' id='berikutnya' class='btn-biru'><?= $mode==1?'Berikutnya':'Login'?></button>
                </span>
            



        </div>
    </form>
    </div>



</body>
</html>