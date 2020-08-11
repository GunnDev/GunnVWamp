<?php
/*
Author: Mihir Rao
Gunn Volunteering
*/

require 'GoogleDriveUtils.php';

$util = new GoogleDriveUtils();
$filesList = $util->getFilesForUser();
print_r($filesList);
?>