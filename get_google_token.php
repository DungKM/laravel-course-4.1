<?php

require 'vendor/autoload.php';

use Google\Client;

$client = new Client();
$client->setAuthConfig('storage/app/google/credentials.json');
$client->addScope(Google\Service\Drive::DRIVE_FILE);
$client->setAccessType('offline');
$client->setPrompt('consent');

$authUrl = $client->createAuthUrl();
echo "Vui lòng truy cập vào URL sau và xác thực:\n$authUrl\n\n";
echo "Nhập mã xác thực từ trình duyệt: ";
$authCode = trim(fgets(STDIN));

$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

if (isset($accessToken['refresh_token'])) {
    echo "Refresh Token của bạn là:\n";
    echo $accessToken['refresh_token'] . "\n";
} else {
    echo "Không thể lấy Refresh Token. Vui lòng kiểm tra thiết lập OAuth.\n";
}