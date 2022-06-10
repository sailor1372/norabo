<?php
#Test git 001
#kakunin 002
#thuan 003
  session_start();
	if (isset( $_POST ['submit'])) {
		$conn = mysqli_connect('localhost','sys3_itweb_g','w6AsjMem','sys3_itweb_g'); 
		if (mysqli_connect_errno($conn)) { 
			die("DB Error: " . mysqli_connect_error()); 
		}
		mysqli_query($conn,"set names utf8"); 
		if (isset( $_POST ['submit'])) {
			$email = $_POST ['email'];
			$nick_name = $_POST ['nick_name'];
			$age = $_POST ['age'];    
            $pw = $_POST ['pw'];
            $hash_password = password_hash($pw, PASSWORD_DEFAULT);
            $gender = $_POST['gender'];

			$sql = "SELECT * FROM DB_USER WHERE EMAIL = '$email'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				echo "<script>alert('ユーザーは存在します。')</script>";
			}else{
                $img = "./static/img/e1";
				$sql = "INSERT INTO DB_USER (EMAIL,NICK_NAME,AGE,PW,GENDER,IMG) VALUES ('$email','$nick_name','$age','$hash_password','$gender','$img')";
				if ($conn->query($sql) === TRUE) {
          $sql = "SELECT * FROM DB_USER WHERE EMAIL = '$email'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
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
              
              echo "<script>parent.location.href='sign_in.php';</script>";
            }
          }
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
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
    <title>Sign up</title>
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
          <a href="."><img src="./static/logo.svg" height="150" alt=""></a>
        </div>
        <form class="card card-md" action="" method="post">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">ようこそ！</h2>
            <div class="mb-3">
              <label class="form-label">メールアドレス</label>
              <input type="email" name ="email" class="form-control" placeholder="メールアドレス">
            </div>
            <div class="mb-3">
              <label class="form-label">ニックネーム</label>
              <input type="nick_name" name ="nick_name" class="form-control" placeholder="ニックネーム">
            </div>
            <div class="mb-3">
              <label class="form-label">パスワード</label>
              <div class="input-group input-group-flat">
                <input type="pw" name ="pw" class="form-control"  placeholder="パスワード"  autocomplete="off">
              </div>
            </div>
            <div class="mb-3">
                <!-- -->
                <label class="form-label">年齢（参加者フィルタリングの機能）</label>
                    <select name = "age" class="form-select" aria-label="Default select example">                    
                        <option value="none">選択</option>
                        <option value="1">10代</option>
                        <option value="2">20代</option>
                        <option value="3">30代</option>
                        <option value="4">40代</option>
                        <option value="5">50代</option>
                    </select>
            </div>
            <div class="mb-3">
                <!-- -->
                <label class="form-label">性別 （参加者フィルタリングの機能）</label>
                    <select name = "gender" class="form-select" aria-label="Default select example">                    
                        <option value="none">選択</option>
                        <option value="1">男性</option>
                        <option value="2">女性</option>
                        <option value="3">その他</option>
                        <option value="4">答え無し</option>
                    </select>
            </div>
            <div class="form-footer">
              <button type="submit" name ="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="./sign_in.php" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>
    <script src="./dist/js/tabler.min.js"></script>
  </body>
</html>