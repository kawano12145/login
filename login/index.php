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
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
    <title>アンケート</title>
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
    <h1>アンケート</h1>
    
  <div class="timezone">
  <?php
  date_default_timezone_set('Asia/Tokyo');
  echo date("Y年m月d日 H:i:s");
  
  ?>
  </div>
    <div class="form">
      <form action="post.php" method="post">
   
        <p>
          <label>
            <p>
              性別： 
              <input type="radio" name="gender" value="男性" required/>男性
              <input type="radio" name="gender" value="女性" required/>女性
              <span class="required-label">*</span>
            </label>
        </p>
        </p>
        <p>
        <label>
          
          血液型：
          <select name="blood" required>
            <option value="" disabled selected hidden>選択してください</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="O">O</option>
            <option value="AB">AB</option>
          </select>
          <span class="required-label">*</span>
        </label>
        </p>
        </p>
        <p>
        <label>
          
          好きな食べ物：
          <select name="food" required>
            <option value="" disabled selected hidden>選択してください</option>
            <option value="ハンバーグ">ハンバーグ</option>
            <option value="オムライス">オムライス</option>
            <option value="カレー">カレー</option>
            <option value="ラーメン">ラーメン</option>
            <option value="ピザ">ピザ</option>
          </select>
          <span class="required-label">*</span>
        </label>
        </p>
        </p>
        <p>
        <label>
          
          国籍：
          <select name="country" required>
            <option value="" disabled selected hidden>選択してください</option>
            <option value="日本">日本</option>
            <option value="アメリカ">アメリカ</option>
            <option value="イタリア">イタリア</option>
            <option value="オーストラリア">オーストラリア</option>
            <option value="台湾">台湾</option>
            <option value="その他">その他</option>
          </select>
          <span class="required-label">*</span>
        </label>
        </p>
        </p>
        <p>
        <label>
          
          貯金額：
          <select name="saving" required>
            <option value="" disabled selected hidden>選択してください</option>
            <option value="5万円未満">5万円未満</option>
            <option value="5万円以上～10万円未満">5万円以上～10万円未満</option>
            <option value="10万円以上～20万円未満">10万円以上～20万円未満</option>
            <option value="20万円以上～50万円未満">20万円以上～50万円未満</option>
            <option value="50万円以上">50万円以上</option>
          </select>
          <span class="required-label">*</span>
        </label>
        </p>
        </p>
        <p>
        <label>
          
          生活満足度：
          <input type="range" name="ranges" min="0" max="100" step="1" onmousemove="updateValue(event)">
           <span id="valueDisplay"></span><span>%</span>

            <script>
             function updateValue(event) {
             var rangeInput = event.target;
             var valueDisplay = document.getElementById("valueDisplay");
             valueDisplay.textContent = rangeInput.value;
          }
             </script>
              <span class="required-label">*</span>
         </label>
        </p>
        </p> 
        <p>
        <label>
          ご意見：
          <span class="required-label">*</span>
          <p><textarea name="opinion" cols="42" rows="5" required></textarea>

      </p>
        </label>
        </p>
        <p><input type="submit" name="submitBtn" value="送信" /></p>

      </form>
    </div>
    <div class="button-container">
      <form action="home.php">
        <input type="submit" value="HOME画面へ" />
      </form>
      <form action="logout.php" method="post">
        <input type="submit" value="ログアウト" />
      </form>
    </div>
    <br />
  </body>
</html>
