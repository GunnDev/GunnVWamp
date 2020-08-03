<?php
	// Variables to connect to the database
	$host = "localhost";
	$username = "root";
	$user_pass = "";
	$database_in_use = "gunnvolunteering";

	// create database connection instance using above variables
	$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
?>