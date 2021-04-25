<?php
include_once 'util/Utility.php';
include_once 'util/ApiService.php';
header('Content-Type: text/xml');
$wsResponse = Utility::curl_get(ApiService::RSS_MAHASISWA_URL, array());
echo ($wsResponse);
