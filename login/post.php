<?php

$gender = $_POST["gender"];
$blood = $_POST["blood"];
$food = $_POST["food"];
$country = $_POST["country"];
$saving = $_POST["saving"]; 
$ranges = $_POST["ranges"];
$opinion = $_POST["opinion"];

include "conf.php";

try {
$db = new PDO("mysql:host=localhost;dbname=login;charset=utf8mb4",'admin', '07132722');
$sql = "INSERT INTO form1 (gender, blood, food, country, saving, ranges, opinion) VALUES ('$gender', '$blood', '$food', '$country', '$saving', '$ranges', '$opinion')";

$db->query($sql) === TRUE;

} catch (PDOException $e) {
  // データベース接続エラー時の処理
  $error = 'データベースに接続できませんでした。';
  // エラーメッセージの表示など

}
?>
