<?php
    session_start();
    include "helper.php";
    unset($_SESSION['error-msg']);
    unset($_SESSION['error-email']);
    unset($_SESSION['error-password']);

    if(isset($_SESSION['user'])){
        header('Location: '.$BASE_PATH.'/my-drive.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doodle Drive - Semua file Anda, siap di mana saja Anda berada</title>
    <link rel='stylesheet' href='style/home.css'/>
    <link rel="icon" href="assets/logo.png">
    <script>
        (
            //parallax's here :)
            function () {
                var p1=document.getElementById('p1');

                window.addEventListener('scroll', function() {
                    document.getElementById('p1').style.backgroundPosition = 'right -'+(window.scrollY/25)%window.innerHeight+'px';
                    document.getElementById('p2').style.backgroundPosition = 'right -'+(window.scrollY/25)%window.innerHeight+'px';
                    document.getElementById('p3').style.backgroundPosition = 'right -'+(window.scrollY/25)%window.innerHeight+'px';
                    document.getElementById('p4').style.backgroundPosition = 'right -'+(window.scrollY/25)%window.innerHeight+'px';
                    document.getElementById('header').style.opacity = 1-(window.scrollY/110);

                    console.log(window.scrollY)
                });
            }
        )();
       
    </script>
</head>
<body>
    <div class='navbar-container'>
        <div class='navbar-left'>
            <img src='assets/logo-company.png' style='height:30px'/>
            <p class='navbar-text'>Drive</p>
        </div>

        <div class='navbar-right'>
            <span class='menu-blue' onclick="window.location = 'login.php'">Kunjungi Doodle Drive</span>
        </div>
    </div>

    <div id='p1' class='parallax parallax1'>
        <div id='header' class='section-head'>
            <img class='img-isi' src='assets/logo.png'/>
            <div class='sub-title-mid'>Semua file Anda, siap di mana saja</div>
            <span class='button-blue' style='margin-top:20px' onclick="window.location = 'login.php'">Kunjungi Doodle Drive</span>
        </div> 
    </div>

    <div class='section'>
        <div class='container-left'>
            <img src='assets/files-icon.png' style='width:400px'/>
        </div>
        <div class='container-right'>
            <div class='sub-title'>Menyimpan file apa saja</div>
            <div class='contents'>Simpan foto, cerita, desain, gambar, rekaman, video, dan lain-lain. Dapatkan ruang penyimpanan 100 mb pertama gratis dengan Akun Doodle.</div>    
        </div>
    </div>

    <div id='p2' class='parallax parallax2'></div>

    <div class='section'>
        <div class='container-left'>
            <div class='sub-title'>Lihat file Anda di mana saja</div>
            <div class='contents'>File dalam Drive dapat dijangkau dari berbagai ponsel cerdas, tablet, atau komputer. Ke mana pun Anda pergi, file Anda siap mengikuti.</div>
        </div>
        <div class='container-right'>
            <img src='assets/hand-smartphone.png' style='width:340px'/>
        </div>
    </div>

    <div id='p3' class='parallax parallax3'></div>

    <div class='section-mid'>
        <div style='display:flex; width:820px; justify-content:space-between'>
            <div class='container-img'>
                <img class='img-isi' src='assets/jisoo.jpg'/>
            </div>
            <div class='container-img'>
                <img class='img-isi' src='assets/somi.jpg'/>
            </div>
            <div class='container-img'>
                <img class='img-isi' src='assets/sunmi.jpeg'/>
            </div>
            <div class='container-img'>
                <img class='img-isi' src='assets/mina.jpg'/>
            </div>
            <img class='img-isi' src='assets/people+.jpg'/>
        </div>
        <div class='sub-title-mid'>Berbagi file dan folder</div>
        <div class='contents-mid'>Anda dapat dengan cepat mengundang orang lain untuk melihat, mengunduh, dan berkolaborasi pada semua file – tak perlu lampiran lewat email.</div>
    </div>  
    
    <div id='p4' class='parallax parallax4'></div>

    <div id='main-msg' class='section-end'>
        <img class='img-isi' src='assets/logo.png'/>
        <div class='sub-title-mid'>Mulai pakai Drive, gratis</div>
        <span class='button-blue' style='margin-top:20px' onclick="window.location = 'login.php'">Kunjungi Doodle Drive</span>
    </div>  

    <div id='footer'>
        <div class='text-center'>
            <span class='blue'>d</span><span class='red'>o</span><span class='orange'>o</span><span class='blue'>d</span><span class='green'>l</span><span class='red'>e</span> drive 2019 | DL
        </div>
    </div>
    

</body>

</html>