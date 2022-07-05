<?php 
if(isset($_POST["serch_1"]))  {
			//if($_POST['serch_1'] == 1){
                $user_id = $_POST["user_id"];
				$platt = $_POST["platt"];
				$game = $_POST["game"];
				$same = strval($_POST["same"]);	
				$style = strval($_POST['style']);
				$rank = strval($_POST['rank']);
				$title = $_POST["title"];
				$area_text = $_POST["area_text"];
				
	
                $filter = $same.$style.$rank;
                $conn = mysqli_connect('localhost','sys3_itweb_g','w6AsjMem','sys3_itweb_g'); 
				if (mysqli_connect_errno($conn)) { 
					die("DB Error:  " . mysqli_connect_error()); 
				}
				mysqli_set_charset($conn, "utf8");
	
				$make_room = "INSERT INTO HOME_ROOM (G_NAME,PLATFORM, TITLE, M_TEXT, FILTER, CLIENT_USER, DATE) VALUES(
                    '$game','$platt','$title','$area_text','$filter','$user_id', NOW())";

				$result1 = mysqli_query($conn, $make_room);

				/////////////////////////////////
				$select_r_id = "SELECT * FROM HOME_ROOM WHERE CLIENT_USER = ".$user_id."";
				  mysqli_set_charset($conn, "utf8");
				  $result_select = mysqli_query($conn, $select_r_id);
				  if ($result_select->num_rows > 0) {
					while ($row = $result_select->fetch_assoc()) {
					  $r_id = $row['R_ID'];
					}
				  }
				$make_match ="CREATE TABLE `sys3_itweb_g`.`".$r_id."_MATCH_ROOM` ( 
					`ID` INT(4) NOT NULL , 
					`AUTHORITY` TINYINT(1) NOT NULL , 
					`READY` TINYINT(1) NOT NULL 
					) ENGINE = InnoDB;
					";
				$result2 = mysqli_query($conn, $make_match);

				$insert_match = "INSERT INTO ".$r_id."_MATCH_ROOM (ID, AUTHORITY, READY) 
					VALUES('$user_id', '1', '0' )";

				$inser2 = mysqli_query($conn, $insert_match);




				mysqli_close($conn);
            //}
}

 ?>