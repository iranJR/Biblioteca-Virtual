<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 04/12/2018
 * Time: 10:46
 */

require_once ('../dao/usuarioDao.php');
require_once ('../model/Usuario.php');

/*Inicia a sessão*/
session_start();

/*Verifica se foi setado no input um login e uma senha*/
if(!empty($_POST['login']) && !empty($_POST['senha'])){
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);

    $usuario = new Usuario('','','','','','');
    $dao = new usuarioDao();
    $usuario = $dao->buscarPeloLogin($login, $senha);
    if($usuario->getLogin() == $login && $usuario->getSenha() == $senha){

        $_SESSION['idUsuario'] = $usuario->getIdUsuario();
        $_SESSION['tipoUsuario'] = $usuario->getIdTipoUsuario();
        $_SESSION['nomeUsuario'] = $usuario->getNome();
        echo "<script>window.location.href='../view/index.php'</script>";
    }
    else{
        $msg = "Login ou senha incorretos !";
        echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
    }
}
else{
    $msg = "Por favor digite um login e uma senha !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}