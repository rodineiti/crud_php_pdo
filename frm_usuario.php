<?php  

include_once("controllers/controller_usuario.php");

if(isset($_GET['id'])){
  $id = (int)$_GET['id'];
} else {
  $id = 0;
}

$nome = "";
$email = "";

if(intval($id) != 0){
  $init = new BaoUsuario();
  $init->setId($id);
  $result = $init->buscar_id($init);
  
  if (count($result) > 0) {
    $id = $result['id'];
    $nome = $result['name'];
    $email = $result['email'];    
  } else {
    $id = 0;
    $nome = "";
    $email = "";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tutorial CRUD PHP</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 50px;
    }
    .starter-template {
      padding: 40px 15px;
      text-align: center;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CRUD PHP</a>
      </div>
    </div>
  </nav>

  <div class="container">

      <div class="starter">
        <div class="row">
          <div class="col-sm-6">
              <h1>Formulário de Usuário</h1>
              <div class="modal-body">
              <form role="form" id="db-form" name="db-form" method="post" action="cad_usuario.php">
                <div class="form-group-attached">
                  <div class="row">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="Informe o nome" value="<?=$nome?>" required>
                    </div>
                    
                  </div>      
                  <div class="row">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Informe o e-mail" value="<?=$email?>" required>
                    </div>
                    
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <input type="hidden" name="id" id="id" value="<?=$id?>">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="index.php" class="btn btn-info">Voltar</a>
                  </div>
                </div>
              </form>     
            </div>
          </div>
        </div>
      </div>    
    </div><!-- /.container -->

  <script src="bootstrap/js/jquery-3.1.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
