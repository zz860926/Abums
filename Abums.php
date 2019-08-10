<?php session_start();?>
<html>
    <head>
    <meta charset='utf-8'>
        <title>Abums</title>
    </head>
    <body>
    <h1>相簿目錄</h1>
    <a href="signout.php">登出<a>
    <form id="form" action="adding.php" method="post">
        創建相簿<br>
        主題:<input id="title" name="title" type="text"></input><br>
        <input type="submit"></input>
    </form>
    <script>
    function check(){
        var name = document.getElementById("name");
        var title = document.getElementById("title");
        var errStr =""
        if(title.value == "" || title.value == null){
            errStr += "主題名稱不可為空\n";
        }
        if (errStr == "" || errStr == null)
		{
			return true;
		}
        alert(errStr);
        return false;
    } 
    document.getElementById("form").onsubmit = check;
    </script>
    <table border="1">
    <tr>
        <td>相簿主題
        <td>創建者
        <td>創建時間
    </tr>
    <?php
        $conn=mysqli_connect("localhost","root","","abums");
        if(!$conn){
            echo "连接 MySQL 失败: " . mysqli_connect_error(); 
        }
        mysqli_query($conn,"set names utf8");
        $user = $_SESSION['user'];
        $data = mysqli_query($conn,"SELECT * FROM abum_content WHERE `name` ='$user'");
        $times = mysqli_num_rows($data);
        $href = "Abum.php?title=";
        $href_del = "delete_abum.php?id=";
        while ($row=mysqli_fetch_array($data)){
        ?>
            <tr>
                <td><a href="<?php echo $href,$row["title"] ?>"><span><?php echo $row["title"]; ?></span></a>
                <td><?php echo $row["name"] ?>
                <td><?php echo $row["date"] ?>
                <td><a href="<?php echo $href_del,$row["id"] ?>"><span>刪除相簿</span></a>
            </tr>
        <?php
        }
        mysqli_close($conn);
        ?>
        </table>
    </body>
</html>