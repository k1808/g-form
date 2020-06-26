<?php
$host = 'localhost'; 
		$user = 'root';
		$password = ''; 
		$db_name = 'g_forms'; 
		$link = mysqli_connect($host, $user, $password, $db_name);

$query = "SELECT * FROM coments  WHERE id > 0 ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);