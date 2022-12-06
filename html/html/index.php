<?php 
	$request = $_SERVER['REQUEST_URI'];
	session_start();
	if (!isset($_SESSION["name"]) || empty($_SESSION["name"]))
	{
		require __DIR__ . '/login.php';
	}
	else
	{
		require __DIR__ . '/alta.php';
	}
