<?php
/*
Author: Mihir Rao
Gunn Volunteering
*/

require 'GoogleDriveUtils.php';

$util = new GoogleDriveUtils();
$util->getFilesInDrive();

echo "Testing File Upload...";
$util->uploadFiles("testDocs/jpg_test.jpg");
echo "\nUploaded File.";
?>