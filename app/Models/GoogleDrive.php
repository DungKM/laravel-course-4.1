<?php

namespace App\Models;

use Google\Client;
use Google\Service\Drive;

class GoogleDrive
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName('YourAppName');
        $this->client->setScopes([Drive::DRIVE_FILE, Drive::DRIVE]);
        $this->client->setAuthConfig(storage_path('app/google/credentials.json'));
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
        $tokenPath = storage_path('app/google/token.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);
        }
        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            } else {
                throw new \Exception('The access token has expired and no refresh token is available.');
            }
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
        }
    }

    public function uploadFile($filePath, $fileName, $mimeType, $folderId = null)
    {
        $driveService = new Drive($this->client);

        $fileMetadata = [
            'name' => $fileName,
            'parents' => $folderId ? [$folderId] : []
        ];

        $file = new Drive\DriveFile($fileMetadata);

        $content = file_get_contents($filePath);

        return $driveService->files->create($file, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart'
        ]);
    }
}