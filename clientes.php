  <?php
    require_once 'assets/php/classClients.php';
    require_once 'assets/php/classPhones.php';
    $newclient = new Clients();
    $oldclient = new Clients();
    $newphone = new Phones();

    if (isset($_POST['cadastrar'])) {
      try {
        $newclient->setCPF($_POST['cpf']);
        $newclient->setName($_POST['name']);
        $newclient->setGender($_POST['gender']);

        $id = $newclient->insert();
        if (isset($_POST['telefone'])) {
          $newphone->setNumber($_POST['telefone']);
          $newphone->setClient($id);
          $newphone->insert();
        }
        

          if (isset($_POST['celular'])) {
            if(strlen($_POST['celular']) == 11){
          $newphone->setNumber($_POST['celular']);
          $newphone->setClient($id);
          $newphone->insert();
        }
        }
      } catch (Exception $e) {
        
      }
      # code...
    }

    if(isset($_POST['excluir'])){
      $oldclient->setID($_POST['id']);
      if($oldclient->delete() == NULL){
        echo "Erro ao deletar cliente";
      }else{
        echo "Sucesso ao deletar o cliente";
      }
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

      <nav class="navbar navbar-expand-lg avbar-dark bg-dark">
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

        <li class="nav-item float-right">
              <a class="btn btn-primary" data-toggle="collapse" href="#projetofoda"  data-toggle="collapse" role="button" href="#projetofoda">Cadastro de Clientes</a>
            </li>
      </nav>

<div class="collapse" id="projetofoda">
        <h1 class="display-4 mt-4">Cadastro de Clientes</h1>




        <form action="clientes.php" method="post">


  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">CPF</span>
    </div>
    <input type="text" class="form-control"name="cpf" required>
  </div>


  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
    </div>
    <input type="text" class="form-control"name="name" required>
  </div>
        



  <div class="btn-group btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-secondary active">
      <input type="radio" name="options" value="M" autocomplete="off">Masculino
    </label>
    <label class="btn btn-secondary">
      <input type="radio" name="options" value="F" autocomplete="off">Feminino
    </label>
    <label class="btn btn-secondary">
      <input type="radio" name="options" value="O" autocomplete="off">Outro
    </label>
  </div>


  <div class="input-group mb-3 mt-3">
    <div class="input-group-prepend ">
      <span class="input-group-text" id="inputGroup-sizing-default">Telefone</span>
    </div>
    <input type="text" class="form-control" name="telefone" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">Celular</span>
    </div>
    <input data-toggle="tooltip" data-placement="top" title="(DDD) 9-XXXX-XXXX" type="text" class="form-control" name="celular" required>
  </div>
        
        <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
          </form>
      
</div>



      <div class="container mt-4">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">CPF</th>
              <th scope="col">Nome</th>
              <th scope="col">Gênero</th>
              <th scope="col">Telefones</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $client = new Clients();
              $clients = $client->index();
              while($row = $clients->fetch(PDO::FETCH_OBJ)){
            ?>
            <tr>
              <td><?php echo $row->id; ?></td>
              <td><?php echo $row->cpf; ?></td>
              <td><?php echo $row->name; ?></td>
              <td><?php echo $row->gender; ?></td>
              <td><?php 
                $phone = new Phones();
                $phones = $phone->view($row->id);
                while($row2 = $phones->fetch(PDO::FETCH_OBJ)){
                  echo $row2->number . "<br>";
                }
              ?></td>
              <td>
                <a href="editaCliente.php?id=<?php echo $row->id; ?>"><button class="btn btn-outline-primary btn-block" name="editar">Editar </button></a>
                <form action="clientes.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                  <button class="btn btn-outline-danger mt-2 btn-block" type="submit" name="excluir">Excluir</button>
                </form>


              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="assets/js/jquery-3.3.1.min"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>

    </body>
  </html>