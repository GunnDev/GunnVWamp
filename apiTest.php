<?php
/*
Author: Mihir Rao
Gunn Volunteering
*/

require 'GoogleDriveUtils.php';

$util = new GoogleDriveUtils();
$util->getFilesInDrive();

echo "Testing File Upload...";
$util->uploadFiles();
?>