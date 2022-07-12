<?php
    session_start();
    $conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
    $conn->query("set names'utf8'");
    $conn->set_charset('utf8_general_ci');
    $user_id = $_SESSION['user_id'];

    if($_FILES["file"]["error"]){
        echo $_FILES["file"]["error"];
    } else {
        if(($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png") && $_FILES["file"]["size"]<1024000){
            
            $imgname = $_FILES["file"]["name"];
            
            $filename = "static/usr/".$_FILES["file"]["name"];
            $filename1 = iconv("UTF-8","gb2312",$filename);
            
            move_uploaded_file($_FILES["file"]["tmp_name"],$filename1);

            $sql="UPDATE DB_USER SET IMG = '$imgname' WHERE USER_ID = '$user_id'";
            if($conn->query($sql)){
                $_SESSION['img'] = $imgname;
                echo "<script> parent.location.href='profile_account.php'; </script>";
            }else{
                echo "DB Error";
            };
        } else {
            echo "ファイル形式にエラーがあります。";
        }
    }
    $conn->close();
?>
