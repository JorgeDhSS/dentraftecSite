<?php 
	if(isset($_POST["id"]) && !empty($_POST["id"]))
    	{
    		$dsn = 'mysql:dbname=usersCRUD;host=127.0.0.1';
		$user = 'system';
		$password = '123456Qwert_y';

		try
		{
			$dbh = new PDO($dsn, $user, $password);
		}
		catch (PDOException $e)
		{
			echo "La base de datos no se encuentra disponible";
		}
		$sth = $dbh->prepare('DELETE FROM users WHERE id = :id');
		$sth->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
		$sth->execute();
		
		$results = $sth->fetch();
		session_start();
		if($sth->rowCount() == 0)
		{
			$_SESSION["message"] = "Usuario eliminado";
		}
		else
		{
			session_start();
			$_SESSION["message"] = "Usuario no eliminado";
		}
		header("Location: /");
    	}
