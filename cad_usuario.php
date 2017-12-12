<?php

if($_POST){
  
  include_once("controllers/controller_usuario.php");

  if(isset($_POST['id'])){
    $id = trim($_POST['id']);
  } else {
    $id = 0;
  }

  if(isset($_POST['name'])){
    $nome = trim($_POST['name']);
  } else {
    $nome = "";
  }

  if(isset($_POST['email'])){
    $email = trim($_POST['email']);
  } else {
    $email = "";
  }

  if(intval($id) == 0) {
    
    $verifica = new BaoUsuario();
    $verifica->setStrCampo('email');
    $verifica->setStrValor($email);
    $retorno = $verifica->ifExist($verifica);
    
    if (intval($retorno) == 0) {
      $init = new BaoUsuario();
      $init->setId($id);
      $init->setNome($nome);
      $init->setEmail($email);
      $cadastrar = $init->cadastrar($init);

      if(intval($cadastrar) != 0){
        header("Location: index.php?status=success&msg=Cadastro realizado com sucesso");
      } else {
        header("Location: index.php?status=danger&msg=Houve um erro ao cadastrar o usuário");
      }
    } else {
      header("Location: index.php?status=danger&msg=Já existe um cadastro com o email informado");
    }

  } else {

    $verifica = new BaoUsuario();
    $verifica->setId($id);
    $verifica->setStrCampo('email');
    $verifica->setStrValor($email);
    $retorno = $verifica->ifExist($verifica);
    
    if (intval($retorno) == 0) {
      $init = new BaoUsuario();
      $init->setId($id);
      $init->setNome($nome);
      $init->setEmail($email);
      $atualizar = $init->atualizar($init);

      if(intval($atualizar) != 0){
        header("Location: index.php?status=success&msg=Cadastro atualizado com sucesso");
      } else {
        header("Location: index.php?status=danger&msg=Houve um erro ao cadastrar o usuário");
      }
    } else {
      header("Location: index.php?status=danger&msg=Já existe um cadastro com o email informado");
    }
  }
}

?>