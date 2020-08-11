<?php
/*
Author: Mihir Rao
Gunn Volunteering
*/
require __DIR__ . '/vendor/autoload.php';

class GoogleDriveUtils {
    public $client;
    public $service;

    function __construct() {
        $this->client = new Google_Client();
        $this->client->setApplicationName('Google Drive API PHP Quickstart');
        $this->client->setScopes(Google_Service_Drive::DRIVE);
        $this->client->setAuthConfig('credentials.json');
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');

        $this->service = new Google_Service_Drive($this->client);

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($this->client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $this->client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $this->client->fetchAccessTokenWithAuthCode($authCode);
                $this->client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
        }
    }

    function uploadFiles($filePath, $fileName, $folderName) {
        // 1. Search the existing folder using the folder name.
        $res = $this->service->files->listFiles(array("q" => "name='{$folderName}' and trashed=false"));
        $folderId = '';
        if (count($res->getFiles()) == 0) {
            // 2. When the folder of the folder name is NOT existing, the folder is created by the folder name and the folder ID of the created folder is returned.
            $file = new Google_Service_Drive_DriveFile();
            $file->setName($folderName);
            $file->setMimeType('application/vnd.google-apps.folder');
            $createdFolder = $this->service->files->create($file);
            $folderId = $createdFolder->getId();
        } else {
            // 3. When the folder of the folder name is existing, the folder ID is returned.
            $folderId = $res->getFiles()[0]->getId();
        }

        // 4. The file is uploaded to the folder using the folder ID.
        $file = new Google_Service_Drive_DriveFile();
        $file->setName($fileName);
        $file->setDescription('Volunteer Hours');
        $file->setParents(array($folderId));
        $data = file_get_contents($filePath);
        $createdFile = $this->service->files->create($file, array(
            'data' => $data,
            'uploadType' => 'multipart'
        ));
    }

    function getFilesForUser() {
        // Return list of file names that have been uploaded
        $optParams = array(
            'q' => 'trashed=false',
            'pageSize' => 20,
            'fields' => 'nextPageToken, files(id, name)'
        );
        $results = $this->service->files->listFiles($optParams);

        if (count($results->getFiles()) == 0) {
            return [];
        } else {
            $filesList = [];
            foreach ($results->getFiles() as $file) {
                array_push($filesList, $file->getName());
            }
            return $filesList;
        }
    }
}