<?php
    session_start();
    $name = $_POST['name'];
    $title = $_POST['title'];
    $conn=mysqli_connect("localhost","root","","abums");
    mysqli_query($conn,"set names utf8");
    $rand = rand(1,30000);
    $today = getdate();
    $year = $today["year"]; //年
    $month = $today["mon"]; //月
    $day = $today["mday"];  //日
    $today_date=$year."-".$month."-".$day;
    $user = $_SESSION['user'];
    $data = mysqli_query($conn,"INSERT INTO abum_content(id,name,title,date) VALUES($rand,'$user','$title','$today_date')");
    

    if(!$data){
        die('Error:'.mysqli_error());
    }
    echo "1record added";
    echo $name,$title;
    mysqli_close($conn);
    
    header('Location:Abums.php');
    
?>
