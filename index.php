<?php

require_once('key.php');

$lat = 58.248;
$lon = 22.539;

$url ="https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$key}&units=metric";
/*$url ="https://api.openweathermap.org/data/2.5/weather?lat=58.248&lon=22.539&appid=e1972edfd0e0d2fc39ee696336b44a1c&units=metric";*/

$cahce = 'cahce.json';
$now = time();
$timeout = 600;

/*var_dump(file_exists($cahce));
var_dump($now);
var_dump();
var_dump();*/


if ( !file_exists($cahce) || ($now - filemtime($cahce)) > $timeout ) {

    $content = file_get_contents($url);
    file_put_contents($cahce, $content);

} else {
    $content = file_get_contents($cahce);
    
}
$obj = json_decode($content);   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$obj->name; ?> ilm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h4>Asukoht </h4>
    <h2><?=$obj->name; ?></h2>
    <h4>Temperatuur on <?= $rounded_temp = round($obj->main->temp); ?> C</h4>
    <h4>Tuule kiirus on  <?= $rounded_wind = round($obj->wind->speed); ?> m/s</h4>

    <img src="http://openweathermap.org/img/wn/<?= $obj->weather[0]->icon; ?>@2x.png">
</body>
</html>