<?php 
	$_SESSION["name"] = "";
	session_destroy();
	header("Location: /");
