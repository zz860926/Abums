<?php
$id = $_GET["id"];
$conn=mysqli_connect("localhost","root","","abums");
// $sql = "SELECT * FROM `pictures` WHERE `id` = '$id'";
// $data = mysqli_query($conn,$sql);
$delete = mysqli_query($conn,"DELETE FROM abum_content WHERE `id` = '$id'");

if(!$delete){
    die('Error:'.mysqli_error());
}
echo "1record deleted";
mysqli_close($conn);
header('Location:Abums.php');
?>