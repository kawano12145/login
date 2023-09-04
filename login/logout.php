<?php
session_start();
session_regenerate_id(true);

// セッション変数を破棄します
$_SESSION = array();

// セッションを完全に破棄します
session_destroy();


// リダイレクト
header("Location: login.php");
exit;


