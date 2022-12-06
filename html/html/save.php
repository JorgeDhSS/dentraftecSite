<?php 
	echo "HI";
	$dsn = 'mysql:dbname=usersCRUD;host=127.0.0.1';
	$user = 'system';
	$password = '123456Qwert_y';
	session_start();
	try
	{
		$dbh = new PDO($dsn, $user, $password);
	}
	catch (PDOException $e)
	{
		$_SESSION["message"] = "La base de datos no se encuentra disponible";
	}
	
	if(isset($_POST["id_edit"]) && !empty($_POST["id_edit"]))
    	{
		$sth = $dbh->prepare('UPDATE users SET Nombre = :nombre, email = :mail, password = :password, Direccion = :address WHERE id = :id');
		$sth->bindParam(':nombre', $_POST["name"], PDO::PARAM_STR);
		$sth->bindParam(':mail', $_POST["email"], PDO::PARAM_STR);
		$sth->bindParam(':password', $_POST["password"], PDO::PARAM_STR);
		$sth->bindParam(':address', $_POST["address"], PDO::PARAM_STR);
		$sth->bindParam(':id', $_POST["id_edit"], PDO::PARAM_STR);
		
		
		if($sth->execute())
		{
			$_SESSION["message"] = "Usuario editado";
		}
		else
		{
			$_SESSION["message"] = "Usuario no editado";
		}
    	}
    	else
    	{
    		$sth = $dbh->prepare('INSERT INTO users (Nombre, email, password, Direccion) VALUES (:nombre, :mail, :password, :address)');
		$sth->bindParam(':nombre', $_POST["name"], PDO::PARAM_STR);
		$sth->bindParam(':mail', $_POST["email"], PDO::PARAM_STR);
		$sth->bindParam(':password', $_POST["password"], PDO::PARAM_STR);
		$sth->bindParam(':address', $_POST["address"], PDO::PARAM_STR);
		
		if($sth->execute())
		{
			$_SESSION["message"] = "Usuario agregado";
		}
		else
		{
			$_SESSION["message"] = "Usuario no agregado";
		}
    	}
    	header("Location: /");

?>
