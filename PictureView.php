<html>
    <head>
    <meta charset='utf-8'>
        <title>相簿</title>
    </head>
    <body>
    <table border="1">
    <tr>
        <td>圖片名稱
        <td>圖片描述
        <td>圖片
        <td>創建時間
    </tr>
    <?php
        session_start();
        $conn=mysqli_connect("localhost","root","","abums");
        if(!$conn){
            echo "连接 MySQL 失败: " . mysqli_connect_error(); 
        }
        mysqli_query($conn,"set names utf8");
        $id = $_GET['id'];
        $sql = "SELECT * FROM `pictures` WHERE `id` = '$id'";
        $data = mysqli_query($conn,$sql);
        $href = "Abum.php?title=";
        while ($row=mysqli_fetch_array($data)){
        ?>
            <tr>
                <td><?php echo $row["picture_name"]; ?>
                <td><?php echo $row["picture_content"]; ?>
                <td><img src="<?php echo $row["picture_path"] ?>" height="200px">
                <td><?php echo $row["date"] ?>
            </tr>
        <?php
        }
        mysqli_close($conn);
        ?>
        </table>
        <a href="<?php echo $href,$_SESSION["title"] ?>">返回相簿</a>
    </body>
</html>