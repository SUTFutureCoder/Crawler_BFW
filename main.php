<?php
namespace crawler;

require './fetch/FetchFactory.php';

echo 'Welcome to use project CBFW!' . PHP_EOL;
echo 'I provide severial sites to fetch' . PHP_EOL;
echo '-1- http://jishu.family.baidu.com/' . PHP_EOL;
echo '-2- http://wiki.baidu.com/' . PHP_EOL;
echo 'Please input the number:';

fscanf(STDIN, '%d', $type);

$tempCookiesKey     = '';
$tempCookiesData    = '';
$cookiesArray = array();
echo 'Please input the key and value of cookies devided by blank, end of # #' . PHP_EOL;
while (fscanf(STDIN, '%s%s', $tempCookiesKey, $tempCookiesData) 
        && ($tempCookiesKey != '#' && $tempCookiesData != '#')){
    $cookiesArray[] = array(
        'key'   => $tempCookiesKey,
        'value' => $tempCookiesData,
    );
}

fetch\FetchFactory::fetchData($type)->getData($cookiesArray);