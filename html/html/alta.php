<?php 
	session_start();
	if (!isset($_SESSION["mail"]))
	{
		header("Location: /");
	}
	else
	{
		echo "<p class=\"text-lg mb-0 mr-4\">".(isset($_SESSION["message"]) ? $_SESSION["message"] : "")."</p>";
	}
	$results;
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
		$sth = $dbh->prepare('SELECT * FROM users WHERE id = :id');
		$sth->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
		$sth->execute();
		
		$results = $sth->fetch();
    	}
?>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
</head>
<section class="h-screen">
  <div class="px-6 h-full text-gray-800">
    <div class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6">
      <div class="grow-0 shrink-1 md:shrink-0 basis-auto xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 md:mb-0 grid grid-cols-3 gap-4 content-start h-full">
        <div class="font-bold">Nombre</div>
        <div class="font-bold">Correo</div>
        <div class="font-bold">Acciones</div>
        <?php
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
            $sql = 'SELECT id, Nombre, email FROM users';
	    foreach ($dbh->query($sql) as $row) 
	    {
		print "<div>".$row['Nombre']."</div>";
		print "<div>".$row['email']."</div>";
		print "<div>
			     <form action=\"#\" method=\"post\">
				<input type=\"hidden\" name=\"id\" value=\"".$row['id']."\">
				<button type=\"submit\" class=\"bg-blue-600 p-1 text-white hover:bg-blue-700 m-1\"> Editar </button>
				<button type=\"submit\" class=\"bg-red-600 p-1 text-white hover:bg-red-700 m-1\"  formaction=\"/delete.php\"> Eliminar </button>
			     </form>
			</div>";
	    }
	?>
      </div>
      <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0 items-start">
      	<div class="flex flex-row items-center justify-center lg:justify-end">
            <p class="text-lg mb-0 mr-4">Cerrar sesión</p>
            <form>
		    <button
		      data-mdb-ripple="true"
		      data-mdb-ripple-color="light"
		      formaction="/close.php"
		      formmethod="post"
		      class="inline-block p-3 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out mx-1"
		    >
		      Close
		    </button>
	    </form>
        </div>
        <form action="save.php" method="post">
       	  <?php 
       	  	if(isset($results["id"]))
       	  	{
       	  		echo "<input type=\"hidden\" name=\"id_edit\" value=\"".$results["id"]."\">";
       	  	}
       	  ?> 
          <div
            class="flex items-center my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5"
          >
            <p class="text-center font-semibold mx-4 mb-0">Llene los siguientes datos</p>
          </div>
          <!-- Name input -->
          <div class="mb-6">
            <input
              type="text"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              name="name"
              value="<?php echo $results["Nombre"];?>"
              placeholder="Nombre"
            />
          </div>
	  <div class="mb-6">
            <input
              type="text"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              name="email"
              value="<?php echo $results['email']; ?>"
              placeholder="Correo electrónico"
            />
          </div>
          <!-- Password input -->
          <div class="mb-6">
            <input
              type="password"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              name="password"
              value="<?php echo $results['password']; ?>"
              placeholder="Contraseña"
            />
          </div>
	 <div class="mb-6">
            <input
              type="text"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              name="address"
              value="<?php echo $results['Direccion']; ?>"
              placeholder="Dirección"
            />
          </div>

          <div class="text-center lg:text-left">
            <button
              type="submit"
              class="inline-block px-7 py-3 bg-green-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out"
            >
              Enviar datos
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
