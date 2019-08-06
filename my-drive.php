<?php 
    include 'helper.php';
    session_start();
    $u = $_SESSION['user']??"";
    $emailpre = explode('@',$u['email'])[0];
    $path = $emailpre;

    if(!$u){
        header('Location: '.$BASE_PATH);
    }

    if(isset($_GET['path'])) $path.=$_GET['path'];

    function dirsize($dir)
    {
      @$dh = opendir($dir);
      $size = 0;
      while ($file = @readdir($dh))
      {
        if ($file != "." and $file != "..") 
        {
          $patht = $dir."/".$file;
          if (is_dir($patht))
          {
            $size += dirsize($patht); // recursive in sub-folders
          }
          elseif (is_file($patht))
          {
            $size += filesize($patht); // add file
          }
        }
      }
      @closedir($dh);
      return $size;
    }

    function rrmdir($dir) {
        if (is_dir($dir)) {
          $objects = scandir($dir);
          foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
              if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
            }
          }
          reset($objects);
          rmdir($dir);
        }
     } 

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drive Saya - Doodle Drive</title>
    <link rel='stylesheet' href='style/home.css'/>
    <link rel='stylesheet' href='style/my-drive.css'/>
    <link rel="icon" href="assets/logo.png">

    <script>
        var mode = 0;


        function showPopNew() {
            document.getElementById('pop-newarea').style.display = "block"
            mode = 1;
        }
        function hidePopNew() {
            if(mode==0) document.getElementById('pop-newarea').style.display = "none";
            mode--;
        }

        function showPopNewFolder(){
            document.getElementById('popup-new-folder').style.display = "flex"
        }
        function hidePopNewFolder(){
            document.getElementById('popup-new-folder').style.display = "none"
        }

        window.addEventListener('click', ()=>hidePopNew());

        
    </script>
</head>
<body>
    <span id='popup-new-folder'>
        <div class='new-folder'>
            <div class='bar'>
                <span>New Folder</span>
                <span onclick='javascript:hidePopNewFolder()'>X</span>
            </div>
            <form action='controller/makeFolder.php' method='POST' class='bottom-newfolder'>
                <input type='text' name='folder-name' class='input-text' autofocus/>
                <input type='hidden' name='path' value="<?= $path ?>"   />
                <button type='submit' class='btn-submit'>Make Folder</button>
            </form>
        </div>
    </span>

    <div class='navbar-container2'>
        <div class='navbar-left'>
            <img src='assets/logo.png' style='height:30px'></img>
            <p class='navbar-text2'>Drive</p>
        </div>

        <div class='navbar-right'>
            <span class='name-text'>
                <?= $u['name'];?>
            </span>
            <a href='controller/doLogout.php'>
                <img style='width:35px; margin-left:5px;' src='assets/logout-logo.png'></img>
            </a>
        </div>
    </div>

    <div>
        <div class='panel-left'>
            <span id='new-area' onclick="javascript:showPopNew()">
                <div id='btn-baru' class='btn-baru shadow'>
                    <img src='assets/plus-logo.png' style='width:30px'></img>
                    Baru
                </div>
                <div id='pop-newarea' class='shadow' style='display:none'>
                    <div class='pop-new' onclick='javascript:showPopNewFolder()'>
                        <img src='assets/folder-logo-plus.png' style='width:20px; height:20px'></img>
                        <p class='pop-item-info'>Folder</p>
                    </div>
                    <form action='controller/doUpload.php' method='POST' id='form-fileupload' enctype="multipart/form-data">
                        <input type='hidden' name='path' value="<?= $path ?>"/>
                        <label for='fileupload' class='pop-new'>
                            <img src='assets/file-logo-plus.png' style='width:20px; height:20px'></img>
                            <p class='pop-item-info'>Upload File</p>
                        </label>
                        <input id='fileupload' type='file' name='fileUpload' onchange='form.submit()' style='display:none' />
                    </form>

                </div>
            </span>
            

            <div class='panel-component'>
                <img src='assets/server-logo.png' style='width:20px; height:20px'></img>
                <div style='margin-left:20px'>
                    <p style='margin:0'>Penyimpanan</p>
                    <div class='progress-bar'><div id='fill-progressbar' style='width:<?= dirsize('file/drive/'.$emailpre)*100/16106127360 ?>%'></div></div>
                    <p style='margin:0' class='gray'><?= round(dirsize('file/drive/'.$emailpre)/1073741824, 2) ?> Gb dari 15 Gb telah digunakan</p>
                </div>
            </div>
        </div>
        
        <div class='breadcrumb'>
            <?php 
                // echo $path;
                $breadcrumb = explode('/', $path);
                $bcpro = '';
                foreach($breadcrumb as $bc){
                    if($bc == $emailpre){
                        ?> <a href='<?=$BASE_PATH.'/my-drive.php'?>' class='no-decor'>Drive saya</a> <?php
                    }
                    else{
                        $bcpro.='/'.$bc;
                        echo "&nbsp>&nbsp";
                        ?> <a href='<?=$BASE_PATH.'/my-drive.php?path='.$bcpro?>' class='no-decor'><?= $bc ?></a> <?php
                    }
                }
            ?> 
        </div>
        <div class='panel-right'>
            
            <div class='drive-box'>
                <?php 
                    $folders = scandir("file/drive/$path");
                    foreach($folders as $f){ 
                        if($f == '.' || $f == '..') continue; 
                        if(is_dir("file/drive/$path/$f")){ 
                        ?>
                        <span class='folder'>
                            <img src='assets/folder-logo.png' style='width:20px; height:20px'></img>
                            <span style='width:100%; display:flex; justify-content:space-between'>
                                <a href='<?= $BASE_PATH ?>/my-drive.php?path=<?= ($_GET['path']??'').'/'.$f ?>' class='ellipsis no-decoration' style='margin-left:15px;'>
                                <?= $f ?>
                                </a>
                                <span style='display:flex'>
                                    <a href='<?= $BASE_PATH.'/'."file/drive/$path/$f" ?>' target="_blank" class='no-decoration'>
                                        <img src='assets/download-logo.png' style='width:20px; height:20px'/>
                                    </a>
                                    <form action='controller/doDelete.php' method='POST'>
                                        <input type='hidden' name='path' value="<?= $path ?>"/>
                                        <input type='hidden' name='file-name' value="<?= $f ?>"/>
                                        <label for='btn-submit<?=$f?>' class='btn-delete'><img src='assets/trash-logo.png' style='width:20px; height:20px'/></label>
                                        <button id='btn-submit<?=$f?>' type='submit' style='display:none'></button>
                                    </form>
                                </span>
                            </span>
                        </span>
                    <?php 
                        }
                    }
                ?>
            </div>

            <div class='drive-box'>
                <?php 
                    $file = scandir("file/drive/$path");
                    foreach($file as $f){ 
                        if($f == '.' || $f == '..') continue; 
                        if(!is_dir("file/drive/$path/$f")){ 
                            $extension = explode('.', $f)[1];
                        ?>
                           
                                <span href='<?= $BASE_PATH.'/'."file/drive/$path/$f" ?>' target="_blank" class='file no-decoration'>
                                    <div class='file-thumbnail'><?= $extension!='png'&&$extension!='jpg'&&$extension!='jpeg'?$extension:"<img class='img-isi' src='file/drive/$path/$f'/>" ?></div>
                                    <div class='file-info'>
                                        <img src='assets/file-logo.png' style='width:20px; height:20px'/>
                                        <span class='ellipsis file-title' style='margin-left:15px;'>
                                        <?= $f ?>
                                        </span>
                                        <span style='display:flex'>
                                            <a href='<?= $BASE_PATH.'/'."file/drive/$path/$f" ?>' target="_blank" class='no-decoration'>
                                                <img src='assets/download-logo.png' style='width:20px; height:20px'/>
                                            </a>
                                            <form action='controller/doDelete.php' method='POST'>
                                                <input type='hidden' name='path' value="<?= $path ?>"/>
                                                <input type='hidden' name='file-name' value="<?= $f ?>"/>
                                                <label for='btn-submit<?=$f?>' class='btn-delete'><img src='assets/trash-logo.png' style='width:20px; height:20px'/></label>
                                                <button id='btn-submit<?=$f?>' type='submit' style='display:none'></button>
                                            </form>
                                        </span>
                                    </div>
                                </span>
                            
                    <?php 
                        }
                    }
                ?>
            </div>



            



        </div>






    </div>






</body>
</html>