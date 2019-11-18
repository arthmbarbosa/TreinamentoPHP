<?php
	require_once("assets/php/classClients.php");

	$newclient = new Clients();

	if (isset($_POST['atualizar'])) {
		try {
			$newclient->setID($_POST['id']);
			$newclient->setCPF($_POST['cpf']);
			$newclient->setName($_POST['name']);
			$newclient->setGender($_POST['gender']);

			$newclient->update();

			echo "<div class='alert alert-success' role='alert'>CLIENTE ATUALIZADO COM SUCESSO!!</div>";

		} catch (Exception $e) {
			echo $e;
		}
		# code...
	}
  ?>






<!doctype html>
<html lang="pt-br">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/main.css">

    <title>Store</title>

  </head>

  <body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.html">Store</a> 
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clientes.php">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vendas.php">Vendas</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <h1>Cadastro de Clientes</h1>
    </div>

    <?php 
    	$client = new Clients();
    	$client->setID($_GET['id']);
    	$client = $client->view();

    	switch ($client->gender) {
    		case 'M':
    			$m = "selected";
    			$f = " ";
    			$o = " ";
    			break;
    		
    		case 'F':
    			$m = " ";
    			$f = "selected";
    			$o = " ";
    			break;

    		case 'O':
    			$m = " ";
    			$f = " ";
    			$o = "selected";

    		break;
    	}



    ?>
    <div class="container ">
      <form  action="editaCliente.php?id=<?php echo $client->id; ?>" method="post">
        <label class="col-2 col-form-label">CPF</label>
        <input  class="d-block" type="text" name="cpf" value="<?php echo $client->cpf; ?>" required>


       <label class="col-2 col-form-label">Nome</label>
        <input  class="d-block" type="text" name="name" value="<?php echo $client->name; ?>" required>
      

      <label class="col-2 col-form-label">Gênero</label>
      <select  class="d-block" name="gender">
        <option value="M" <?php echo $m; ?>>Masculino</option>

        <option value="F"<?php echo $f; ?>> Feminino</option>

        <option value="O"<?php echo $o; ?>>Outro</option>
      </select>

      <input type="hidden" name="id" value="<?php echo $client->id; ?>">

      <button type="submit" class="btn btn-primary mt-4" name="atualizar">Atualizar</button>
        </form>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>