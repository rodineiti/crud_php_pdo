<?php

if($_GET){
  
  include_once("controllers/controller_usuario.php");
  
  if(isset($_GET['id'])){
    $id = trim($_GET['id']);
  } else {
    $id = 0;
  }

  $init = new BaoUsuario();
  $init->setId($id);

  if (intval($id) != 0){
    $retorno = $init->deletar($init);
    if(intval($retorno) == 1){
      header("Location: index.php?status=success&msg=Cadastro deletado com sucesso");
    } else {
      header("Location: index.php?status=danger&msg=Houve um erro ao tentar deletar o registro");
    }
  } else {
    header("Location: index.php?status=danger&msg=ID não informado ou não existe");
  } 
}

?>