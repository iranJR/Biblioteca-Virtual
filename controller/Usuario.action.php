<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 04/12/2018
 * Time: 10:17
 */

require_once ("../model/Usuario.php");
require_once ("../dao/usuarioDao.php");

if($_GET['act'] == 'save') {
    if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['login'])
        && !empty($_POST['senha']) && !empty($_POST['tipoUsuario'])) {
        try {
            $usuario = new Usuario('','','','','','');
            $usuario->setNome($_POST['nome']);
            $usuario->setCpf($_POST['cpf']);
            $usuario->setLogin($_POST['login']);
            $usuario->setSenha(md5($_POST['senha']));
            $usuario->setIdTipoUsuario($_POST['tipoUsuario']);

            $dao = new usuarioDao();
            $dao->salvar($usuario);

            $msg = "Registro realizado com sucesso!";
            echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao salvar: " . $erro->getMessage();
            echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=$msg'</script>";
        }

    } else {
        $msg = "Erro: preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=$msg'</script>";
    }
}