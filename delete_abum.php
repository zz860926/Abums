<?php
$title = $_GET["title"];
$conn=mysqli_connect("localhost","root","","abums");
mysqli_query($conn,"SET NAMES utf8");
$sql = "SELECT * FROM pictures WHERE title = '$title'";
$data = mysqli_query($conn,$sql);
chdir("Pictures");    //切換到Pictures/資料夾 

while($row=mysqli_fetch_array($data)){
    print_r($row);
    $path = $row["picture_path"];
    $filename = substr($path,9);
    unlink($filename);
    $delete = mysqli_query($conn,"DELETE FROM pictures WHERE `picture_path` = '$path'"); 
} 
$delete = mysqli_query($conn,"DELETE FROM abum_content WHERE `title` = '$title'");
if(!$delete){
    die('Error:'.mysqli_error());
}
echo "1record deleted";
mysqli_close($conn);
header('Location:Abums.php');
?>