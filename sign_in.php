<?php
  session_start();
	if (isset( $_POST ['submit'])) {
        $conn = mysqli_connect('localhost','sys3_itweb_g','w6AsjMem','sys3_itweb_g'); 
		if (mysqli_connect_errno($conn)) { 
			die("连接 MySQL 失败: " . mysqli_connect_error()); 
		}
		mysqli_query($conn,"set names utf8"); 
		$email = $_POST['email'];
		$pw = $_POST['pw'];
		$sql = "SELECT * FROM USER WHERE EMAIL = '$email'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$checkpassword = $row["PW"];
				
				if(password_verify($pw, $checkpassword) || $pw == $checkpassword){
					$id = $row['ID'];  
					$nick_name = $row["NICK_NAME"];
					$email = $row["EMAIL"];
					$gender = $row['GENDER'];
					$age = $row['AGE'];
					$img = $row["IMG"];              
					
					$_SESSION['id'] = $id;
					$_SESSION['email'] = $email;
					$_SESSION['nick_name'] = $nick_name;
					$_SESSION['age'] = $age;
					$_SESSION['gender'] = $gender;
					$_SESSION['img'] = $img;

					echo "<script>parent.location.href='Home.php';</script>";
				}else{
					echo "<script>alert('パスワードが間違えた')</script>";
				}
			}
	   }else{
			echo "<script>alert('ユーザーは存在しません')</script>";
		}
		$conn->close();
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign in</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css" rel="stylesheet"/>
	
  </head>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="."><img src="./static/ssi.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md"  method="POST" action="./Sign-In.php">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to your account</h2>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email" value = "1@ecc.ac.jp">
            </div>
				<div class="mb-2">
					<label class="form-label">
					  パスワード
					</label>
					<div class="input-group input-group-flat">
					  <input type="pw" name = "pw" class="form-control"  placeholder="Password"  autocomplete="off" value = "1">
					</div>
					<small class="form-hint">
						実演のため、ユーザーとパスワード提供されました、<br>ご安心に使ってください。
					</small>
				 </div>
            <div class="form-footer">
              <button type="submit" name ="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          NORABOに交流しよう！ <a href="./sign_up.php" tabindex="-1">Sign up</a>
        </div>
      </div>
    </div>
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
  </body>
</html>