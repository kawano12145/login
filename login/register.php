<?php
// データベースの接続情報
$host = 'localhost';
$dbname = 'login';
$username = 'admin';
$password = '07132722';
$error = '';

try {
    // データベースに接続
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // ログインフォームが送信された場合の処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ユーザーが入力した情報を取得
        
        
        $name = ($_POST['name'] ?? '');
        $username = ($_POST['username'] ?? '');
        $password = ($_POST['password'] ?? '');

        if (empty($name) || empty($username) || empty($password)) {
          $error = '<span style="color: red;">ユーザー名・メールアドレス・パスワードを入力してください。</span>';
                // $name, $username, $password のいずれかが空の場合の処理
            
        } else {
            // データベースにユーザー情報を保存
            $stmt = $db->prepare('INSERT INTO users (name,username, password) VALUES (?, ?, ?)');
            $stmt->execute([$name,$username, password_hash($password, PASSWORD_DEFAULT)]);

            echo '<script>
            alert("登録が完了しました。");
            </script>';

            


        }
    }
} catch (PDOException $e) {

    $error = '<span style="color: red;">このユーザー名またはパスワードは既に使用されています。</span>';
    // エラーメッセージの表示など
}

?>


<?php
// セッションの開始
session_start();

// CSRFトークンの生成
$csrf_token = bin2hex(random_bytes(32));

// 生成したトークンをセッションに保存
$_SESSION['csrf_token'] = $csrf_token;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="register.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録</title>
</head>

<body>
  <header>
    <h1>
    新規登録画面
  </h1>
  <style> .timezone {
    color:#5555;
    text-align:center;
  }
  </style>
  <div class="timezone">
  <?php
  date_default_timezone_set('Asia/Tokyo');
  echo date("Y年m月d日 H:i:s");
  
  ?>
  </div>
  
  <br />
  </header>
<div class="register">
    <form action="" method="POST">
     

        <label for="login-name"
        ><span>名前</span>
        <input id="name" name="name" type="text" placeholder="ユーザー名を入力"/><br />
      </label>

        <label for="login-mail"
        ><span>メールアドレス</span>
        <input id="username" name="username" type="email" placeholder="メールアドレスを入力"/><br />
      </label>
        

        <label for="login-pass"
        ><span>パスワード</span>
        <input type="password" id="password" name="password" placeholder="パスワードを入力"/><br />
      </label>
      <br />
        <form action="login.php">
        <button name="register" type="submit">登録する</button>
        </form>

    </form>
        
    
<br />
    
        <form action="login.php">
          <button name="login" type="submit">ログイン</button>
        </form>
</div>

<br />
<br />




</body>


<div class="error">
<?php echo $error; ?></div>

</html>