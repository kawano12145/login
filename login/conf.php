
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
if (!isset($gender,$blood,$food,$country,$saving,$ranges,$opinion)) {
  header("Location: conf_screen.php");
  exit();
}


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="conf.css" />
    <title></title>
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
    <h1>入力内容確認</h1>
    
   
  <div class="timezone">
  <?php
  date_default_timezone_set('Asia/Tokyo');
  echo date("Y年m月d日 H:i:s");
  
  ?>
  </div>
    <div class="form">
  
    <p>性別：<?= $gender ?></p>
    <p>血液型：<?= $blood ?></p>
    <p>好きな食べ物：<?= $food ?></p>
    <p>国籍：<?= $country ?></p>
    <p>貯金額：<?= $saving ?></p>
    <p>生活満足度：<?= $ranges ?></p> 
    <p>ご意見：<?= $opinion ?></p>
    <br />
    <form action="date.php" style="text-align: right;">
      <input type="submit" value="送信" />
    </form>
  </div>
  <br />
  <div class="button-container">

    <form action="index.php">
      <input type="submit" value="修正する" />
    </form>
  </div>

    
  </body>
</html>
