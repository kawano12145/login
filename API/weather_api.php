<?php
$api_key = "1e4b8a2b4f9b4cd9a0d63016232507";
$city = "Tokyo";
$api_url = "http://api.weatherapi.com/v1/history.json?key={$api_key}&q={$city}&dt=";

function convertWeatherToJapanese($description) {
    $weather_map = array(
        "Sunny" => "晴れ",
        "Partly cloudy" => "晴れ時々曇り",
        "Cloudy" => "曇り",
        "Overcast" => "くもり",
    );
    return isset($weather_map[$description]) ? $weather_map[$description] : $description;
}

echo "東京の５日間の気象情報：<br><br>";

for ($i = 0; $i < 5; $i++) {
    $date = new DateTime();
    $date->modify("-{$i} days");
    $weather_date = $date->format('Y-m-d');
    echo "日付: {$weather_date}<br>";

    $response = file_get_contents($api_url . $weather_date);
    $response = json_decode($response, true);

    if ($date && isset($response['forecast']['forecastday'][0]['day'])) {
        // $weather_description = $response["forecast"]['forecastday'][0]['day']['condition']["text"];
        $max_temp = $response['forecast']['forecastday'][0]['day']['maxtemp_c'];
        $min_temp = $response['forecast']['forecastday'][0]['day']['mintemp_c'];
        // $weather_description_jp = convertWeatherToJapanese($weather_description);

        // echo "天気: {$weather_description_jp}<br>";
        echo "最高気温: {$max_temp}℃<br>";
        echo "最低気温: {$min_temp}℃<br><br>";
    } if ($date && isset($response['forecast']['forecastday'][0]['astro'])) {
          $sunrise = $response['forecast']['forecastday'][0]['astro']['sunrise'];
          $sunset = $response['forecast']['forecastday'][0]['astro']['sunset'];

        echo "日の出時刻: {$sunrise}<br>";
        echo "日没時刻: {$sunset}<br>";
    }
    
    else {
        echo "日付: {$weather_date}<br>";
        echo "データが取得できませんでした<br><br>";
    }
}
?>
