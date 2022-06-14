<?php
	session_start();
	if (empty($_SESSION['email'])){
		echo "<script> parent.location.href='sign_in.php'; </script>";
	}else{        
		$id = $_SESSION['id'];
		$email = $_SESSION['email'];
		$nick_name = $_SESSION['nick_name'];
        $age = $_SESSION['age'];
        $gender = $_SESSION['gender'];
        $img =  $_SESSION['img'];   

        ///session ok
	} 
    
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
</head>

<body>
	<main class="index">
		<!-- head 後ほど作成 -->
		<a href="room_1.html" class="index__room">
			<!-- 【!】ルームを作成してあると出る -->
			<h2 class="index__room--headline">まったりやりたい時用</h2> <!-- 【!】ルームタイトル -->
			<ul class="index__room--condition">
				<!-- 【!】ルームの条件 -->
				<li class="index__room--condition--list">同性</li>
				<li class="index__room--condition--list">ガチ</li>
				<li class="index__room--condition--list">シルバー</li>
			</ul>
			<div class="index__room--user">
				<!-- 【!】現在接続している他ユーザーリスト -->
				<ul>
					<!-- 【!】現在接続している他ユーザーのアイコン -->
					<li class="index__room--user--list"><img src="" alt="/" class="index__room--user--icon"></li>
					<li class="index__room--user--list"><img src="" alt="/" class="index__room--user--icon"></li>
					<li class="index__room--user--list"><img src="" alt="/" class="index__room--user--icon"></li>
					<li class="index__room--user--list"><img src="" alt="/" class="index__room--user--icon"></li>
					<li class="index__room--user--list"><img src="" alt="/" class="index__room--user--icon"></li>
				</ul>
				<p>接続数:
					<span class="index__room--user--active">8</span> <!-- 【!】現在接続している人数 -->
				</p>
			</div>
		</a>
		<button class="index__add">＋</button> <!-- ルームを作成するボタン -->

		<div class="index__modal">
			<!-- ルームを作成するモーダル（JS未実装） -->
			<h2 class="index__modal--headline">ルーム作成</h2>
			<form action="" class="index__modal--form">
				<h3 class="index__modal--form--headline">マッチする人の性別</h3>
				<label><input type="radio" name="gender">同性がいい</label>
				<label><input type="radio" name="gender" checked>気にしない</label>
				<h3 class="index__modal--form--headline">プレイスタイル</h3>
				<label><input type="radio" name="style" checked>ガチ</label>
				<label><input type="radio" name="style">楽しく</label>
				<h3 class="index__modal--form--headline">ランク</h3>
				<label><input type="radio" name="rank" checked>ブロンズ以下</label>
				<label><input type="radio" name="rank">シルバー</label>
				<label><input type="radio" name="rank">ゴールド</label>
				<label><input type="radio" name="rank">ダイヤ</label>
				<label><input type="radio" name="rank">マスター・プレデター</label>
				<h3 class="index__modal--form--headline">ルーム名（あなたのホームに表示されます）</h3>
				<input type="text" placeholder="例:楽しくプレイする" class="index__modal--form--text">
				<button class="index__modal--form--add">作る</button> <!-- 【!】すべてのデータを保管できるように実装をお願いします。 -->
			</form>
		</div>
	</main>
</body>

</html>