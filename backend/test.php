<?php
/*
Author: Mihir Rao
Gunn Volunteering
*/

require 'GoogleDriveUtils.php';

$util = new GoogleDriveUtils();
$filesList = $util->getFilesInDrive();
print_r($filesList);
?>