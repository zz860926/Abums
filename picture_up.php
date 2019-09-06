<?php
    session_start();
    $name = '';
    $content = '';
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
    if(isset($_POST['submit'])){
        // Count total files
        $countfiles = count($_FILES['file']['name']);
        // Looping all files
        for($i=0;$i<$countfiles;$i++){
            $id = rand(1,30000);
            $filetype = $_FILES['file']['type'][$i];
            $filepath = $_FILES['file']['tmp_name'][$i];
            //file type check (only png/jpg) and rename id
            if($filetype == "image/jpg"){
                $target_path = $id.".jpg";
                $uploadOk = 1;
            }else if($filetype == "image/png"){
                $target_path = $id.".png";
                $uploadOk = 1;
            }else if($filetype == "image/jpeg"){
                $target_path = $id.".jpeg";
                $uploadOk = 1;
            }else{
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
        //角度選轉調整
            $image = imagecreatefromstring(file_get_contents($filepath));
                $exif = exif_read_data($filepath);
                if(!empty($exif['Orientation'])) {
                    echo $exif['Orientation'];
                    switch($exif['Orientation']) {
                        case 3:
                            $image = imagerotate($image,180,0);
                            break;
                        case 6:
                            $image = imagerotate($image,-90,0);
                            break;
                        case 8:
                            $image = imagerotate($image,90,0);
                            break;
                    }
                imagejpeg($image, $filepath);
            }
            // //縮圖製作
            // $pic = imagecreatefromjpeg($filepath);
            // $pic_w = imagesx($pic);
            // $pic_h = imagesy($pic);
            // if ($pic_w > $pic_h) {
            //     $thumb_w = 100;
            //     $thumb_h = intval($pic_h / $pic_w * 100);
            // } else {
            //     $thumb_h = 100;
            //     $thumb_w = intval($pic_w / $pic_h * 100);
            // }
            // $thumb = imagecreatetruecolor($thumb_w, $thumb_h);
            // imagecopyresized($thumb, $pic, 0, 0, 0, 0, $thumb_w, $thumb_h, $pic_w, $pic_h);
            // imagejpeg($thumb, "Pictures/thumb/".$target_path);
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            }else{
                if(move_uploaded_file($filepath,iconv("UTF-8","big5","Pictures/".$target_path))){
                    echo "圖片:".$_FILES['file']['name'][$i]."上傳成功!";
                }else{
                    echo "檔案上傳失敗，在試一次!";
                }
            }
            $user = $_SESSION['user'];
            $title = $_SESSION["title"];
            //$path = 'Pictures/'.$target_path;
            $data = mysqli_query($conn,"INSERT INTO pictures(id,title,name,picture_name,picture_content,picture_path,date) VALUES('$id','$title','$user','$name','$content','$target_path','$today_date')");
            // if(!$data){
            //     die('Error:'.mysqli_error());
            // }
            
        }
        mysqli_close($conn);
        //header('Location:Abum.php?title='.$title);
    }
?>
