<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 17:58
 */

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$data = date("Y-m-d");

require_once ("../model/Usuario.php");
require_once ("../dao/usuarioDao.php");
require_once ("../model/Exemplar.php");
require_once ("../dao/exemplarDao.php");
require_once ("../model/Reserva.php");
require_once ("../dao/reservaDao.php");

if($_GET['act'] == 'save') {
    if (!empty($_POST['login']) && !empty($_POST['dataReserva'])) {

        $usuario = new Usuario('','','','','','');
        $usuarioDAO = new usuarioDao();
        $usuario = $usuarioDAO->buscarByLogin($_POST['login']);

        if($usuario->getLogin() == ""){
            $msg = "Atenção: Usuário não encontrado com o login informado !";
            echo "<script>window.location.href='../view/reservaUsuario.view.php?msg=$msg&exemplar=".$_POST['id']."'</script>";
        }

        $exemplar = new Exemplar('','','','','','');
        $exemplarDAO = new exemplarDao();
        $exemplar = $exemplarDAO->buscarPeloId($_POST['id']);

        $reserva = new Reserva('','','','');
        $reserva->setIdUsuario($usuario->getIdUsuario());
        $reserva->setIdLivro($exemplar->getIdLivro());
        $reserva->setDataReserva(date('Y-m-d', strtotime($_POST['dataReserva'])));

        $reservaDAO = new reservaDao();
        $reservaDAO->salvar($reserva);

        $msg = "Reserva realizada com sucesso!";
        echo "<script>window.location.href='../view/exibirReservas.view.php?msg=$msg'</script>";

    }
}

if($_GET['act'] == 'del') {
    if (!empty($_GET['id'])) {

        $reserva = new Reserva('','','','');

        $reservaDAO = new reservaDao();
        $reserva = $reservaDAO->buscarPeloId($_GET['id']);

        $reservaDAO->apagar($reserva);

        $msg = "Reserva cancelada com sucesso!";
        echo "<script>window.location.href='../view/exibirReservas.view.php?msg=$msg'</script>";
    }
}

