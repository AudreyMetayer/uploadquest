  <?php
  
//if(empty($_POST['deleteFile'])) {
//    header('Location: /upload.php');
//}

$deleteFile = __DIR__. '/uploads/' . $_POST['deleteFile'];
if(file_exists($deleteFile)) {
    unlink("$deleteFile");
}
header('Location: /upload.php');
