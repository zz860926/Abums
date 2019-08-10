<?php
    session_start();
    $acc = $_POST['acc'];
    $pwd = $_POST['pwd'];
    $conn=mysqli_connect("localhost","root","","abums");
    mysqli_query($conn,"set names utf8");
    $sql = "SELECT * FROM `users` WHERE `account` = '$acc'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if($row["account"]==$acc && $row["password"]==$pwd){
        $_SESSION['user'] = $acc;
        header('Location:Abums.php');
    }else{
        echo "<script>alert('帳號或密碼有誤'); location.href = 'index.html';</script>";
    }
?>