<?php

// データベースの接続情報
$host = 'localhost';
$dbname = 'weather';
$username = 'admin';
$password = '07132722';

//APIの接続情報
$api_key = '1e4b8a2b4f9b4cd9a0d63016232507';
$city = 'Tokyo';
$api_url = "http://api.weatherapi.com/v1/history.json?key={$api_key}&q={$city}&dt=";

// function convertWeatherToJapanese($description)
// {
//     $weather_map = array(
//         'Sunny' => '晴れ',
//         'Partly cloudy' => '晴れ時々曇り',
//         'Cloudy' => '曇り',
//         'Overcast' => 'くもり',
//     );
//     return isset($weather_map[$description]) ? $weather_map[$description] : $description;
// }

echo "東京の５日間の気象情報：<br><br>";


try {
  // データベースに接続
  $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


// ５日前から今日までの天気と気温を表示
for ($i = 0; $i < 5; $i++) {
    $date = new DateTime();
    $date->modify("-{$i} days");
    $weather_date = $date->format('Y-m-d');

    // APIからデータを取得
    $response = file_get_contents($api_url . $weather_date);
    $data = json_decode($response, true);

    // 日付が今日以前の場合に表示
    if ($data && isset($data['forecast']['forecastday'][0]['day'])) {
       
        $max_temp = $data['forecast']['forecastday'][0]['day']['maxtemp_c'];
        $min_temp = $data['forecast']['forecastday'][0]['day']['mintemp_c'];

        // 天気の日本語表現に変換
        // $weather_description_jp = convertWeatherToJapanese($weather_description);

          // データベースに保存
          $stmt = $db->prepare("INSERT INTO weather_data (weather_date, max_temp, min_temp) VALUES (?, ?, ?)");
          $stmt->execute([$weather_date, $max_temp, $min_temp]);


        echo "日付: {$weather_date}<br>";
       
        echo "最高気温: {$max_temp}℃<br>";
        echo "最低気温: {$min_temp}℃<br><br>";
    } else {
        echo "日付: {$weather_date}<br>";
        echo "データが取得できませんでした<br><br>";
    }
}
} catch (PDOException $e) {
  echo "データベース接続エラー: " . $e->getMessage();
}
?>
