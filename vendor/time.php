<?php
require(APP_ROOT_VENDOR."xml2array.php");

$que = getVariable($_GET['city'], "lima");
$url = "http://www.google.com/ig/api?weather=lima&hl=es";


	/* USAMOS CURL */
$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($c);
curl_close($c);

$data = xml2array($contents);
$weather_current = $data['xml_api_reply']['weather']['current_conditions'];
$weather_forecast = $data['xml_api_reply']['weather']['forecast_conditions'];

