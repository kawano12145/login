<?php


$timeout = 600; // 30分（30分 * 60秒）

// セッションクッキーのパラメータを設定します
session_set_cookie_params($timeout);



session_start();

// セッションが存在する場合にセッションタイムアウトを更新
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
  session_unset();
  session_destroy();
  header("Location: login.php"); // ログインページへリダイレクト
  exit();
}

// 最終アクティビティのタイムスタンプを更新
$_SESSION['LAST_ACTIVITY'] = time();

session_regenerate_id(true);
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="home.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>home</title>
  
  <script>
    // セッションタイムアウト時のアラートを表示する関数
    function showTimeoutAlert() {
        alert("セッションがタイムアウトしました。再度ログインしてください。");
        window.location.href = "login.php"; // ログインページへリダイレクト
    }

    // タイムアウトまでのカウントダウン
    function startTimeoutCountdown() {
        var timeoutSeconds = <?php echo $timeout; ?>;
        setTimeout(showTimeoutAlert, timeoutSeconds * 1000);
    }

    // ページが読み込まれた際にカウントダウンを開始
    window.onload = startTimeoutCountdown;
</script>

</head>

<body>
  <header>
    <h1>
    HOME画面</h1>
  
  
  <div class="timezone">
  <?php
  date_default_timezone_set('Asia/Tokyo');
  echo date("Y年m月d日 H:i:s");
  
  ?>
  </div>
  
  
  </header>


  <h2><div class="username">
    <?php echo $_SESSION['username']; ?> </div>さん、ようこそ！</h2>



<div class="link">
<a href="index.php">アンケート記入を始める</a>
</div>
<br />

  <form action="logout.php" method="post">
    <input type="submit" value="ログアウト"/>
</form>
  
</body>
</html>