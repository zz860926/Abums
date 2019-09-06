<?php 
session_start();
$conn=mysqli_connect("localhost","root","","abums");
if(!$conn){
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
}
mysqli_query($conn,"set names utf8");

//刪除本機實體檔案
$title = $_SESSION["title"];
$user= $_SESSION["user"];
$sql = "SELECT * FROM `pictures` WHERE `name`='$user' AND `title`='$title'";
$data = mysqli_query($conn,$sql);

$dir_array = array('Pictures','thumb');
foreach($dir_array as $dir){
    chdir("$dir");
    echo getcwd();
    while ($row=mysqli_fetch_array($data)){
        $filename = $row["picture_path"];
        if(file_exists($filename)){
            unlink($filename);
            echo "刪除檔案成功";
        }else{
            echo "檔案不存在，刪除檔案失敗!";
        }
    }
}

//刪除資料庫檔案資料
$delete = mysqli_query($conn,"DELETE FROM pictures WHERE `name`='$user' AND `title`='$title'");
if(!$delete){
    die('Error:'.mysqli_error());
}
echo "all deleted";
mysqli_close($conn);
//header('Location:Abum.php?title='.$title);
?>