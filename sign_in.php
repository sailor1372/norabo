<?php
session_start();
if (isset($_POST['submit'])) {
  $conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
  if (mysqli_connect_errno($conn)) {
    die("DB Error:  " . mysqli_connect_error());
  }
  mysqli_query($conn, "set names utf8");
  $email = $_POST['email'];
  $pw = $_POST['pw'];
  //$hash_password = password_hash($pw, PASSWORD_DEFAULT);
  $sql = "SELECT * FROM DB_USER WHERE EMAIL = '$email'";
  $result = $conn->query($sql);
  echo "<script>alert(" . $pw . ")</script>";
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $checkpassword = $row["PW"];
      if ($pw == $checkpassword) {
        $user_id = $row['USER_ID'];
        $nick_name = $row["NICK_NAME"];
        $email = $row["EMAIL"];
        $gender = $row['GENDER'];
        $age = $row['AGE'];
        $img = $row["IMG"];

        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;
        $_SESSION['nick_name'] = $nick_name;
        $_SESSION['age'] = $age;
        $_SESSION['gender'] = $gender;
        $_SESSION['img'] = $img;

        //LOGIN時間の更新
        $up_sql = "UPDATE DB_USER SET LOGIN = '1', LAST_LOGIN = NOW() WHERE ID = '$user_id'";
        if (mysqli_connect_errno($conn)) {
          die("DB Error " . mysqli_connect_error());
        }
        mysqli_set_charset($conn, "utf8");
        $up_result = mysqli_query($conn, $up_sql);
        echo "<script>parent.location.href='home.php';</script>";
      } else {
        echo "<script>alert('パスワードが間違えた')</script>";
      }
    }
  } else {
    echo "<script>alert('ユーザーは存在しません')</script>";
  }
  $conn->close();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!--  google   -->
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="741740137200-ftfh5aajgmb23p8hhjdlp5v8c3dv6ej0.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <title>Sign in</title>
  <!-- CSS files -->
  <link href="./dist/css/tabler.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-flags.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-payments.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet" />
  <link href="./dist/css/demo.min.css" rel="stylesheet" />

</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
  <div class="page page-center">
    <div class="container-tight py-4">
      <div class="text-center mb-4">
        <a href="."><img src="./static/logo.svg" height="150" alt=""></a>
      </div>
      <form class="card card-md" method="POST" action="./sign_in.php">
        <div class="card-body">
          <h2 class="card-title text-center mb-4" style="font-size:25px">こんにちは</h2>
          <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>

          <script>
            function onSignIn(googleUser) {
              // Useful data for your client-side scripts:
              var profile = googleUser.getBasicProfile();
              console.log("ID: " + profile.getId()); // Don't send this directly to your server!
              console.log('Full Name: ' + profile.getName());
              console.log('Given Name: ' + profile.getGivenName());
              console.log('Family Name: ' + profile.getFamilyName());
              console.log("Image URL: " + profile.getImageUrl());
              console.log("Email: " + profile.getEmail());

              // The ID token you need to pass to your backend:
              var id_token = googleUser.getAuthResponse().id_token;
              console.log("ID Token: " + id_token);
            }
          </script>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" value="1@ecc.ac.jp">
          </div>
          <div class="mb-2">
            <label class="form-label">
              パスワード
            </label>
            <div class="input-group input-group-flat">
              <input type="password" name="pw" class="form-control" placeholder="Password" autocomplete="off" value="$2y$10$XZmX6vQxpTXTr">

            </div>
            <small class="form-hint">
              テストのため、ユーザーとパスワードが提供されました、<br>
            </small>
          </div>
          <div class="form-footer">
            <button type="submit" name="submit" class="btn btn-primary w-100">Sign in</button>
          </div>
        </div>
      </form>
      <div class="text-center text-muted mt-3">
        NORABOに合流しよう！ <a href="./sign_up.php" tabindex="-1">Sign up</a>
      </div>
    </div>
  </div>
  <!-- Tabler Core -->
  <script src="./dist/js/tabler.min.js"></script>
</body>

</html>