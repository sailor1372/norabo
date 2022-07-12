<?php
session_start();
if (empty($_SESSION['email'])) {
  echo "<script> parent.location.href='sign_in.php'; </script>";
} else {
  $user_id = $_SESSION['user_id'];
  $email = $_SESSION['email'];
  $nick_name = $_SESSION['nick_name'];
  $age = $_SESSION['age'];
  $gender = $_SESSION['gender'];
  $img =  $_SESSION['img'];  
  $room_num = $_SERVER["QUERY_STRING"];
  ///session ok
}
$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_errno($conn)) {
  die("DB Error " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
$sql_select = "	SELECT * FROM ".$room_num."_MATCH_ROOM WHERE USER_ID =".$user_id."" ;
$result_select = mysqli_query($conn, $sql_select);
				  if ($result_select->num_rows > 0) {
            while ($row = $result_select->fetch_assoc()) {
              $serch_id = $row['USER_ID'];
              if($user_id == $serch_id){
                continue;
              }
            }
				  }else{
            $insert_match = "INSERT INTO ".$room_num."_MATCH_ROOM (USER_ID, AUTHORITY, READY) VALUES('$user_id', '0', '0' )";
                $inser2 = mysqli_query($conn, $insert_match);
          }
//リーマップ
$sql_select = "	SELECT * FROM ".$room_num."_MATCH_ROOM";
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
    $USER_ID = $row['USER_ID'];
    $AUTHORITY = $row['AUTHORITY'];
    $READY = $row['READY'];
    echo '
    <tr>
	    <td>'.$USER_ID.'</td>
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
