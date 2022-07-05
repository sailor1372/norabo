<?php
session_start();
if (empty($_SESSION['email'])) {
  echo "<script> parent.location.href='sign_in.php'; </script>";
} else {
  $id = $_SESSION['id'];
  $email = $_SESSION['email'];
  $nick_name = $_SESSION['nick_name'];
  $age = $_SESSION['age'];
  $gender = $_SESSION['gender'];
  $img =  $_SESSION['img'];  
 
  $room_num = $_SERVER["QUERY_STRING"];
  ///session ok
}
$sql_select = "	SELECT * FROM ".$room_num."_MATCH_ROOM";
$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_errno($conn)) {
  die("DB Error " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
$result_select = mysqli_query($conn, $sql_select);
if($result_select != FALSE){
    echo '
    <table border="1">
        <th>ID</th>
        <th>AUTHORITY</th>
        <th>READY</th>
        

    ';
if ($result_select->num_rows > 0) {
  while ($row = $result_select->fetch_assoc()) {
    $ID = $row['ID'];
    $AUTHORITY = $row['ID'];
    $READY = $row['READY'];

    echo '
    <tr>
	    <td>'.$ID.'</td>
	    <td>'.$AUTHORITY.'</td>
        <td>'.$READY.'</td>
	</tr>
    

    
    ';
  }
  echo'
  </table>
  ';
}
}else{
    echo'
    <h1>ルームが存在していません。</h1>
    ';
}
$conn->close();
