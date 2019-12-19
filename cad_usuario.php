<?php

if($_POST){
  
  function __autoload($classe) {
    if (file_exists("models/{$classe}.class.php")) {
      include_once "models/{$classe}.class.php";
    }
  }

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

  if(isset($_POST['emails'])){
    $emails = trim($_POST['emails']);
  } else {
    $emails = "";
  }

  if(intval($id) == 0) {
    
    $verifica = new Usuario();
    $verifica->field = "emails";
    $verifica->value = $emails;
    
    if (!$verifica->ifExist()) {
      $init = new Usuario();
      $init->nome = $nome;
      $init->emails = $emails;
      
      if(intval($init->cadastrar()) != 0){
        header("Location: index.php?status=success&msg=Cadastro realizado com sucesso");
      } else {
        header("Location: index.php?status=danger&msg=Houve um erro ao cadastrar o usuário");
      }
    } else {
      header("Location: index.php?status=danger&msg=Já existe um cadastro com o emails informado");
    }

  } else {

    $verifica = new Usuario($id);
    $verifica->field = "emails";
    $verifica->value = $emails;
    
    if (!$verifica->ifExist()) {
      $init = new Usuario($id);
      $init->nome = $nome;
      $init->emails = $emails;
      
      if(intval($init->atualizar()) != 0){
        header("Location: index.php?status=success&msg=Cadastro atualizado com sucesso");
      } else {
        header("Location: index.php?status=danger&msg=Houve um erro ao cadastrar o usuário");
      }
    } else {
      header("Location: index.php?status=danger&msg=Já existe um cadastro com o emails informado");
    }
  }
}

?>