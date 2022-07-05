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
 

  ///session ok
}
$sql_select = "	SELECT * FROM DB_USER";
$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_errno($conn)) {
  die("DB Error " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
$result_select = mysqli_query($conn, $sql_select);
if ($result_select->num_rows > 0) {
  while ($row = $result_select->fetch_assoc()) {
    $IMG = $row['IMG'];
  }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>norabo</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/index.css">
  <!-- CSS files -->
  <link href="./dist/css/tabler.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-flags.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-payments.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet" />
  <link href="./dist/css/demo.min.css" rel="stylesheet" />
</head>
<body>
  <main class="index">
    <div class="container-xl">
      <!-- head 後ほど作成 -->
      <div style="text-align:center ;">
        <a href=""><img src="./static/logo.svg" height="120" alt=""></a>
      </div>
      <body class="antialiased">
        <div class="wrapper">
          <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
              <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <div class="row g-2 align-items-center">
                  <div class="col-3 col-sm-4 col-md-2 col-xl pt-3">
                    <a href="./home.php?pc">
                    <button class="btn btn-yellow btn-pill w-100" name="btn_pc">
                      PC
                    </button>
                    </a>
                  </div>
                  <div class="col-3 col-sm-4 col-md-2 col-xl pt-3">
                  <a href="./home.php?ps4">
                    <button class="btn btn-primary btn-pill w-100" name="btn_ps4">
                      PS4
                    </button>
                    </a>
                  </div>
                  <div class="col-3 col-sm-4 col-md-2 col-xl pt-3">
                  <a href="./home.php?xbox">
                    <button class="btn btn-success btn-pill w-100" name="btn_xbox">
                      XBOX
                    </button>
                    </a>
                  </div>
                  <div class="col-3 col-sm-4 col-md-2 col-xl pt-3">
                  <a href="./home.php?">
                    <button class="btn btn-secondary btn-pill w-100" name="btn_vic">
                      勝ち
                    </button>
                    </a>
                  </div>
                  <div class="col-3 col-sm-4 col-md-2 col-xl pt-3">
                  <a href="./home.php?">
                    <button class="btn btn-secondary btn-pill w-100" name="btn_same">
                      同性
                    </button>
                    </a>
                  </div>

              </h1>

              <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                  <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(./static/usr/<?php echo $IMG ?>)"></span>
                    <div class="d-none d-xl-block ps-2">
                      <div><?php echo $nick_name ?></div>
                      <div class="mt-1 small text-muted"></div>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="./profile_account.php" class="dropdown-item">マイページ</a>
                    <a href="./logout.php" class="dropdown-item">ログアウト</a>
                  </div>
                </div>
              </div>
            </div>
          </header>
          <div class="row">
            <div class="col-sm">
              <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#modal-scrollable">
                <h3>自動参加 </h3>
              </a>
            </div>
          </div>
          <div class="page-body">
            <div class="row row-cards">
              <div class="row g-2 align-items-center">


                <?php
                $platform = $_SERVER["QUERY_STRING"];
                if($platform != ""){
                  $sql_select =  "	SELECT * FROM HOME_ROOM WHERE PLATFORM = '$platform'";
                }else{
                  $sql_select = "	SELECT * FROM HOME_ROOM";
                }               
                $conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
                if (mysqli_connect_errno($conn)) {
                  die("DB Error " . mysqli_connect_error());
                }
                mysqli_set_charset($conn, "utf8");
                $result_select = mysqli_query($conn, $sql_select);
                if ($result_select->num_rows > 0) {
                  while ($row = $result_select->fetch_assoc()) {
                    $R_ID = $row['R_ID'];
                    $GAME = $row['G_NAME'];
                    $PLATFORM = $row['PLATFORM'];
                    $TITLE = $row['TITLE'];
                    $M_TEXT = $row['M_TEXT'];
                    $FILTER = $row['FILTER'];
                    $CLIENT_USER = $row['CLIENT_USER'];
                    $DATE = $row['DATE'];

                    echo '
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header">
                      ' . $GAME;

                    if ($PLATFORM == "PS4") {
                      echo '<a href="#" class="badge badge-outline text-blue">PS4</a>';
                    } elseif ($PLATFORM == "PC") {
                      echo '<a href="#" class="badge badge-outline text-orange">PC</a>';
                    } elseif ($PLATFORM == "XBOX") {
                      echo '<a href="#" class="badge badge-outline text-green">XBOX</a>';
                    } 
                    //FILTER = "000" 同性、スタイル、ランク
                    if (substr($FILTER, 0, 1) == "1") {
                      echo ' <a href="#" span class="badge badge-outline text-yellow">同性</a>';
                    }
                    echo '
                    </div>
                    <div class="row row-0">
                      <div class="col-3">
                        <img src="./static/game/' . strtolower($GAME) . '.jpg" class="w-100 h-100 object-cover" alt="Card side image">
                      </div>
                      <div class="col">
                        <div class="card-body">
                          <h3 class="card-title">' . $TITLE . '</h3>
                          <p class="text-muted">' . $M_TEXT . '</p>
                          <a href="./room.php?'.$R_ID.'" class="btn btn-primary">参加する</a>
                        </div>
                        <div class="card-footer text-muted">
                          <div>
                            <h4>1/4</h4>
                          </div>
                          ' . $DATE . '
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                
                
                ';
                  }
                }
                $conn->close();
                ?>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">ルームに参加</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" id="mk_room">
                      <label class="form-label">フラットフォーム</label>
                      <div class="form-selectgroup">
                        <input id="user_hidden" type="hidden" value="<?php echo $id ?>">
                        <label class="form-selectgroup-item">
                          <input type="radio" name="platt" value="PC" class="form-selectgroup-input" checked>
                          <span class="form-selectgroup-label">PC</span>
                        </label>
                        <label class="form-selectgroup-item">
                          <input type="radio" name="platt" value="PS4" class="form-selectgroup-input">
                          <span class="form-selectgroup-label">PS4</span>
                        </label>
                        <label class="form-selectgroup-item">
                          <input type="radio" name="platt" value="XBOX" class="form-selectgroup-input">
                          <span class="form-selectgroup-label">XBOX
                          </span>
                        </label>
                      </div>
                      <h3 class="index__modal--form--headline">ゲーム</h3>
                      <select type="text" id="game" class="form-select" placeholder="Select a date" value="">
                        <?php
                        $sql_select = "	SELECT * FROM GAME";
                        $conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
                        if (mysqli_connect_errno($conn)) {
                          die("DB Error " . mysqli_connect_error());
                        }
                        mysqli_set_charset($conn, "utf8");
                        $result_select = mysqli_query($conn, $sql_select);
                        if ($result_select->num_rows > 0) {
                          while ($row = $result_select->fetch_assoc()) {
                            $GAME = $row['G_NAME'];
                            echo '<option value="' . $GAME . '">' . $GAME . '</option>';
                          }
                        }
                        $conn->close();
                        ?>
                      </select>
                      <h3 class="index__modal--form--headline">マッチする人の性別</h3>
                      <label class="form-check form-switch">
                        <input class="form-check-input" id="same" type="checkbox">
                        <span class="form-check-label">同じ性別</span>
                      </label>
                      <h3 class="index__modal--form--headline">プレイスタイル</h3>
                      <label><input type="radio" name="style" value="0" checked>楽しく</label>
                      <label><input type="radio" name="style" value="1">ガチ</label>
                      <h3 class="index__modal--form--headline">ランク</h3>
                      <select type="text" id="rank" class="form-select" placeholder="Select a date">
                        <option value="1">ブロンズ以下</option>
                        <option value="2">シルバー</option>
                        <option value="3">ゴールド</option>
                        <option value="4">ダイヤ</option>
                        <option value="5">マスター・プレデター</option>
                      </select>

                      <!-- もし生成物されているルームがないと自分で生成する案内ページを表示
							<h3 class="index__modal--form--headline">ルーム名（あなたのホームに表示されます）</h3>
							<input type="text" placeholder="例:楽しくプレイする" class="index__modal--form--text"> -->
                      <!-- 【!】すべてのデータを保管できるように実装をお願いします。 -->
                      <a href="#" id="r_serch" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#modal-danger">参加</a>
                      <!--【!】すべてのデータを保管できるように実装をお願いします。 -->
                    </form>
                  </div>
                </div>
              </div>
            </div>



            <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  <div class="modal-status bg-danger"></div>
                  <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M12 9v2m0 4v.01" />
                      <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <div class="progress">
                      <div class="progress-bar progress-bar-indeterminate bg-green"></div>
                    </div>
                    <h3>該当するルームが見つかりません。</h3>
                    <div class="text-muted">上記条件からルームを生成しますか？</div>
                  </div>
                  <div class="modal-footer">
                    <div class="w-100">
                      <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                            いいえ
                          </a></div>
                        <div class="col"><button type="submit" id="btn_yes" class="btn btn-outline-primary w-100" onClick="close_pop();" data-bs-toggle="modal" data-bs-target="#modal-report" data-bs-dismiss="modal">
                            はい
                          </button></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>




            <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">ルームの生成</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-2">
                      <label class="form-label">ルーム名</label>
                      <input type="text" id="room_title" class="form-control" name="example-text-input" placeholder="こんにちは！">
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div>
                          <label class="form-label">内容</label>
                          <textarea class="form-control" id="area_text" rows="3"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                      キャンセル
                    </a>
                    <!--  <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal"> -->
                    <button type="submit" id="make_click" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                      <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                      </svg>
                      生成
                    </button>
                  </div>
                </div>
              </div>
            </div>
  </main>
  <script src="./dist/js/tabler.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript">
    function close_pop(flag) {
      $('#modal-danger').hide();
    };
  </script>
  <script>
    $(document).ready(function() {
      //PS4
      $(document).on('click', 'button[name="btn_pc"]', function() {
        //alert("PC");
      });
      $(document).on('click', 'button[name="btn_ps4"]', function() {
        //alert("PS4");
      });
      $(document).on('click', 'button[name="btn_xbox"]', function() {
        //alert("XBOX");
      });
      $(document).on('click', 'button[name="btn_vic"]', function() {
        //alert("勝ち");
      });
      $(document).on('click', 'button[name="btn_same"]', function() {
        //alert("同性");
      });
      ////
      $(document).on('click', '#make_click', function() {
        if ($('#rank').val() == "") {
          alert("Name is empty");
        } else {
          //platt = $('input[name="platt"]').val(); nameから取得
          platt = $('input[name="platt"]:checked').val();
          game = $('#game').val();
          if ($('#same').prop('checked')) {
            same = 1;
          } else {
            same = 0;
          }
          style = $('input[name="style"]:checked').val();
          rank = $('#rank').val();
          user_id = $('#user_hidden').val();
          title = $('#room_title').val();
          area_text = $('#area_text').val();
          serch_1 = 1;
          /*
          alert(
            "[TEST]" + "\n" +
            "serch_1 : " + serch_1 + "\n" +
            "ユーザーID: " + user_id + "\n" +
            "フラットフォーム：" + platt + "\n" +
            "ゲーム：" + game + "\n" +
            "マッチング性別：" + same + "\n" +
            "プレイスタイル：" + style + "\n" +
            "ランク：" + rank + "\n" +
            "ルームタイトル :" + title
          );
          */

          $.ajax({
            url: "room_serch.php",
            method: "POST",
            data: {
              user_id: user_id,
              serch_1: serch_1,
              platt: platt,
              game: game,
              same: same,
              style: style,
              rank: rank,
              title: title,
              area_text: area_text
            },
            success: function(data) {
              location.reload();
            }
          });
        }
      });





    });
  </script>

</body>

</html>