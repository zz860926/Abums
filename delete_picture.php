<?php
session_start();
$id = $_GET["id"];
$conn=mysqli_connect("localhost","root","","abums");
$sql = "SELECT * FROM `pictures` WHERE `id` = '$id'";
$data = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_array($data)){
    $path = $row["picture_path"];
}
$filename = $path;
$delete = mysqli_query($conn,"DELETE FROM pictures WHERE `id` = '$id'");
chdir("Pictures");
if(file_exists($filename)){
    unlink($filename);
    echo "刪除檔案成功";
}else{
    echo "檔案不存在，刪除檔案失敗!";
}
if(!$delete){
    die('Error:'.mysqli_error());
}
echo "1record deleted";
mysqli_close($conn);
header('Location:Abum.php?title='.$_SESSION["title"]);
?>