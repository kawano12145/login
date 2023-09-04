
<?php

$api_url = "http://localhost:8080/API/create_api/testAPI.php";

// Fetch data from the API
$response = file_get_contents($api_url);
$data = json_decode($response, true);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">

   
    
    <title>東京有名な寺院10選</title>
</head>
<body>
    <div class="bg_pattern"></div>
<div class="container">
        <div class="header">
            <h1>東京の有名な寺院</h1>
        </div>
        <h2>寺院一覧</h2>
        <ul class="temple-list">
            <?php
            foreach ($data["data"] as $temple) {
                echo '<li class="temple-list-item">';
                echo '<span class="temple-name">' . $temple["name"] . '</span><br>';
                echo '<a class="temple-location" href="' . $temple["url"] . '" target="_blank">' . $temple["location"] . '</a>';
                echo '</li>';
            }
            
            
            ?>
            </ul>
           
</body>
</html>
