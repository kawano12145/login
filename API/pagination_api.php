<?php
//タイムアウト時間
ini_set('max_execution_time', 7200);


// データベースの接続情報
$host = 'localhost';
$dbname = 'weather';
$username = 'admin';
$password = '07132722';

//APIの接続情報
$api_key = '1e4b8a2b4f9b4cd9a0d63016232507';
$city = 'Tokyo';
$api_url = "http://api.weatherapi.com/v1/history.json?key={$api_key}&q={$city}&dt=";

function convertWeatherToJapanese($description)
{
    $weather_map = array(
        'Sunny' => '晴れ',
        'Partly cloudy' => '晴れ時々曇り',
        'Cloudy' => '曇り',
        'Overcast' => 'くもり',
        'Mist' => '霧',
        'Patchy rain possible' => '時折雨',
        'Patchy snow possible' => '時折雪',
        'Patchy sleet possible' => '時折みぞれ',
        'Patchy freezing drizzle possible' => '時折霧雨',
        'Thundery outbreaks possible' => '雷雨の可能性あり',
        'Blowing snow' => '吹雪',
        'Blizzard' => '吹雪',
        'Fog' => '霧',
        'Freezing fog' => '凍結霧',
        'Patchy light drizzle' => '時折小雨',
        'Light drizzle' => '小雨',
        'Freezing drizzle' => '凍結霧雨',
        'Heavy freezing drizzle' => '激しい凍結霧雨',
        'Patchy light rain' => '時折小雨',
        'Light rain' => '小雨',
        'Moderate rain at times' => '時々中雨',
        'Moderate rain' => '中雨',
        'Heavy rain at times' => '時々大雨',
        'Heavy rain' => '大雨',
        'Light freezing rain' => '軽い凍結雨',
        'Moderate or heavy freezing rain' => '中程度または大雨の凍結',
        'Patchy light snow' => '時折小雪',
        'Light snow' => '小雪',
        'Patchy moderate snow' => '時折中雪',
        'Moderate snow' => '中雪',
        'Patchy heavy snow' => '時折大雪',
        'Heavy snow' => '大雪',
        'Ice pellets' => 'アイスペレッツ',
        'Light rain shower' => '小雨',
        'Moderate or heavy rain shower' => '中程度または大雨',
        'Torrential rain shower' => '豪雨',
        'Light sleet showers' => '小さなみぞ',
        'Moderate or heavy sleet showers' => '中程度または激しいみぞれ',
        'Light snow showers' => '小雪',
        'Moderate or heavy snow showers' => '中程度または激しい雪',
        'Light showers of ice pellets' => '小さなアイスペレッツ',
        'Moderate or heavy showers of ice pellets' => '中程度または激しいアイスペレッツ',
        'Patchy light rain with thunder' => 'ときどき雷雨の小雨',
        'Moderate or heavy rain with thunder' => '中程度または激しい雷雨',
        'Patchy light snow with thunder' => 'ときどき雷の小雪',
        'Moderate or heavy snow with thunder' => '中程度または激しい雷雪',
    );
    return isset($weather_map[$description]) ? $weather_map[$description] : $description;
}

echo "東京の過去1年間の気象情報:<br><br>";


// ...

try {
  // データベースに接続
  $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

  
  $data_per_page = 100;                                // １回のループで取得するデータの数（１ページあたりのデータ数）


  $total_days = 365;                                   // ループ回数を計算（表示する総日数）
  $total_pages = ceil($total_days / $data_per_page);   //総日数を1ページあたりのデータ数で割って、必要なページ数を計算

  
  $batch_weather_data = [];                            // ページごとのデータをバッチ保存するための配列を初期化
  $api_data_cache = [];                                // APIからのデータを一時的に保存するキャッシュを初期化

  // ５日前から今日までの天気と気温をページネーションで表示
  for ($page = 1; $page <= $total_pages; $page++) {
    $start_index = ($page - 1) * $data_per_page;       //現在のページに表示するデータの開始インデックスを計算しページ2では指定された表示データ数（$data_per_page）の値から始まる

    for ($i = $start_index; $i < min($start_index + $data_per_page, $total_days); $i++) {  //ページ内のデータのループ.各ページに表示するデータの範囲を計算し,データの取得が指定された日数（$total_days）に制限されているため、範囲が最大日数を超えないように min() 関数を使用
        $date = new DateTime();
        $date->modify("-{$i} days");
        $weather_date = $date->format('Y-m-d');

        // APIからデータを取得（キャッシュをチェック）
        if (isset($api_data_cache[$weather_date])) {                    //$weather_date という日付をキーとして、既にキャッシュされたデータがあるかどうかをチェック
            $data = $api_data_cache[$weather_date];                     //キャッシュが存在する場合は、そのデータを変数 $data に格納
        } else {                      
            $response = file_get_contents($api_url . $weather_date);    
            $data = json_decode($response, true);
            $api_data_cache[$weather_date] = $data;                     //$data に格納されたデータを、キャッシュとして $api_data_cache 配列に保存。同じ日付のデータが再度要求された場合には、キャッシュから直接データを取得できるようになる。
        }

          // 日付が今日以前の場合にバッチ保存用の配列に追加
          if ($data && isset($data['forecast']['forecastday'][0]['day'])) {
              $weather_description = $data['forecast']['forecastday'][0]['day']['condition']['text'];
              $max_temp = $data['forecast']['forecastday'][0]['day']['maxtemp_c'];
              $min_temp = $data['forecast']['forecastday'][0]['day']['mintemp_c'];

              // 天気の日本語表現に変換
              $weather_description_jp = convertWeatherToJapanese($weather_description);

              // バッチ保存用の配列に追加
              $batch_weather_data[] = [$weather_date, $weather_description_jp, $max_temp, $min_temp];

              echo "日付: {$weather_date}<br>";
              echo "天気: {$weather_description_jp}<br>";
              echo "最高気温: {$max_temp}℃<br>";
              echo "最低気温: {$min_temp}℃<br><br>";
          } else {
              echo "日付: {$weather_date}<br>";
              echo "データが取得できませんでした<br><br>";
          }
      }

      // バッチ保存
      if (!empty($batch_weather_data)) {                                  
          $stmt = $db->prepare("INSERT INTO weather_data (weather_date, weather_description, max_temp, min_temp) VALUES (?, ?, ?, ?)"); 
      //バッチ保存のため、$batch_weather_data 配列内の各天気データを順番に処理。
          foreach ($batch_weather_data as $weather_data) {
              $stmt->execute($weather_data);
          }

          // バッチ保存用の配列をリセット
          $batch_weather_data = [];
      }
  }
  // データベース接続を終了
$db = null;

} catch (PDOException $e) {
  echo "データベース接続エラー: " . $e->getMessage();
}

    // ループ内でのデータベースへの保存を避ける手順
    //APIから取得したデータを一時的に変数に格納し、全てのループが終了した後に
    //まとめてデータベースに保存する。
    //1回のループでのデータベースへの保存処理の回数が減り、タイムアウトを回避できる。
    //$api_data_cache というキャッシュ変数を使用して、同じ日付のデータをAPIから複数回取得するのを防ぎます。すでに取得したデータはキャッシュしておき、再度同じ日付が必要になった場合にはキャッシュから取得します。