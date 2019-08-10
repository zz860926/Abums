<?php
    $name = $_POST['p_name'];
    $content = $_POST['p_content'];
    $conn=mysqli_connect("localhost","root","","abums");
    mysqli_query($conn,"set names utf8");
    //id
    $rand = rand(1,30000);
    //時間
    $today = getdate();
    $year = $today["year"]; //年
    $month = $today["mon"]; //月
    $day = $today["mday"];  //日
    $today_date=$year."-".$month."-".$day;
    //檔案
    $uploadOk = 1;
    $target_path = "Pictures/";
    $id = rand(1,30000);
    $filetype = $_FILES['myfile']['type'];

    //file type check (only png/jpg) and rename id
    if($filetype == "image/jpg"){
        $target_path.= $id.".jpg";
        $uploadOk = 1;
    }else if($filetype == "image/png"){
        $target_path.= $id.".png";
        $uploadOk = 1;
    }else if($filetype == "image/jpeg"){
        $target_path.= $id.".jpeg";
        $uploadOk = 1;
    }else{
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    }else{
        if(move_uploaded_file($_FILES['myfile']['tmp_name'],iconv("UTF-8","big5",$target_path))){
            echo "圖片:".$_FILES['myfile']['name']."上傳成功!";
        }else{
            echo "檔案上傳失敗，在試一次!";
        }
        session_start();
        $user = $_SESSION['user'];
        $title = $_SESSION["title"];
        $data = mysqli_query($conn,"INSERT INTO pictures(id,title,name,picture_name,picture_content,picture_path,date) VALUES('$id','$title','$user','$name','$content','$target_path','$today_date')");
        
    
        if(!$data){
            die('Error:'.mysqli_error());
        }
        echo "1record added";
        echo $name,$content;
        mysqli_close($conn);
        header('Location:Abum.php?title='.$title);
    }
?>
