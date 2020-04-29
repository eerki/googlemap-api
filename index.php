<?php
    $url = 'http://api.openweathermap.org/data/2.5/weather?appid=8caaa6f19586adc84d0dbea077ecab2f&lat=58.2550&lon=22.4919&units-metric';

    $cacheFile = './cache.json';
    $cacheTime= 300;

    if ( file_exists($cacheFile) && (time() - filemtime($cacheFile)) <$cacheTime ) {
        $content = file_get_contents($cacheFile);
        echo "cache";
    } else {
        $content = file_get_contents($url);
        echo "api";

        $file = fopen($cacheFile, 'w');
        fwrite($file, $content);
        fclose($cacheFile);
    }

    $json = json_decode($content);

    //var_dump($json->weather[0]->icon);

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>API WeatherMap1</title>
    </head>
    <body>
        <img src="http://openweathermap.org/img/wn/<?php echo $json->weather[0]->icon?>@2x.png">
        <div class="desc">Description: <?php echo $json->weather[0]->description?></div>
        <div class="temp">Temperature: <?php echo $json->main->temp?></div>
        <div class="wind">Wind speed: <?php echo $json->wind->speed?></div>
        <div class="humi">Humidity: <?php echo $json->main->humidity?></div>

    </body>
    </html>