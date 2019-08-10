<?php session_start();?>
<html>
    <head>
    <meta charset='utf-8'>
        <title>Abums</title>
    </head>
    <body>
    <h1><?php
    echo $_GET["title"]; 
     ?></h1>
    <h3>上傳圖片</h3>
    <form id="picture_up_form" action="picture_up.php" method="post" enctype="multipart/form-data">
        <input type="file" id="myfile" name="myfile"></input><br>
        圖片名稱:<input id="p_name" name="p_name" type="text"></input><br>
        圖片描述:<input id="p_content" name="p_content" type="text"></input><br>
        <input type="submit"></input>
    </form>
    <script>
    function check(){
        var name = document.getElementById("p_name");
        var file = document.getElementById("myfile");
        var errStr =""
        if(name.value == "" || name.value == null){
            errStr += "圖片名稱不可為空\n";
        }
        if(file.value == "" || file.value == null){
            errStr += "檔案不可為空\n";
        }
        if (errStr == "" || errStr == null)
		{
			return true;
		}
        alert(errStr);
        return false;
    } 
    document.getElementById("picture_up_form").onsubmit = check;
    </script>
    <a href="Abums.php">查看其他相簿</a>
    <table border="1">
    <tr>
        <td>名稱
        <td>圖片
        <td>創建時間
    </tr>
    <?php
        $conn=mysqli_connect("localhost","root","","abums");
        if(!$conn){
            echo "连接 MySQL 失败: " . mysqli_connect_error(); 
        }
        mysqli_query($conn,"set names utf8");
        $href = "PictureView.php?id=";
        $href_delete = "delete_picture.php?id=";
        $_SESSION["title"] = $_GET["title"];
        $title = $_SESSION["title"];
        $user= $_SESSION["user"];
        $data = mysqli_query($conn,"SELECT * FROM pictures WHERE `name`='$user' AND `title`='$title'");
        while ($row=mysqli_fetch_array($data)){
        ?>
            <tr>
                <td><a href="<?php echo $href,$row["id"] ?>"><span><?php echo $row["picture_name"]; ?></span></a>
                <td><img src="<?php echo $row["picture_path"] ?>" height="200px">
                <td><?php echo $row["date"] ?>
                <td><a href="<?php echo $href_delete,$row["id"] ?>">刪除照片</a>
            </tr>
        <?php
        }
        mysqli_close($conn);
        ?>
    </table>   
    </body>
</html>