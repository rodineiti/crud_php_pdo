<?php

if($_GET){
  
  function __autoload($classe) {
    if (file_exists("models/{$classe}.class.php")) {
      include_once "models/{$classe}.class.php";
    }
  }
  
  if(isset($_GET['id'])){
    $id = trim($_GET['id']);
  } else {
    $id = 0;
  }

  if (intval($id) != 0){
    $init = new Usuario($id);
    if(intval($init->deletar()) == 1){
      header("Location: index.php?status=success&msg=Cadastro deletado com sucesso");
    } else {
      header("Location: index.php?status=danger&msg=Houve um erro ao tentar deletar o registro");
    }
  } else {
    header("Location: index.php?status=danger&msg=ID não informado ou não existe");
  } 
}

?>