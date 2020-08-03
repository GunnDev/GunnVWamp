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
$util->uploadFiles("testDocs/png_test.png");
$util->uploadFiles("testDocs/pdf_test.pdf");
$util->uploadFiles("testDocs/docx_test.docx");
echo "\nUploaded File.";
?>