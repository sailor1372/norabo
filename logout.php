<?php
session_start();
$user_id = $_SESSION['user_id'];
$sql="UPDATE DB_USER SET LOGIN = '0', LAST_LOGIN = NOW() WHERE USER_ID = '$user_id'";
$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_errno($conn)) {
  die("DB Error " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
$result = mysqli_query($conn, $sql);
$conn->close();
session_destroy();
?>
<script>
    //alert("logout");
    location.replace('home.php');
</script>