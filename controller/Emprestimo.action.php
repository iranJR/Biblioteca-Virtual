<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 01:43
 */

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$data = date("Y-m-d");

require_once ("../model/Emprestimo.php");
require_once ("../dao/emprestimoDao.php");
require_once ("../model/Usuario.php");
require_once ("../dao/usuarioDao.php");
require_once ("../model/Exemplar.php");
require_once ("../dao/exemplarDao.php");

if($_GET['act'] == 'save') {
    if (!empty($_POST['login']) && !empty($_POST['id'])) {

        $usuario = new Usuario('','','','','','');
        $usuarioDAO = new usuarioDao();
        $usuario = $usuarioDAO->buscarByLogin($_POST['login']);

        if($usuario->getLogin() == ""){
            $msg = "Atenção: Usuário não encontrado com o login informado !";
            echo "<script>window.location.href='../view/emprestimoUsuario.view.php?msg=$msg&exemplar=".$_POST['id']."'</script>";
        }

        $exemplar = new Exemplar('','','','','','');
        $exemplarDAO = new exemplarDao();
        $exemplar = $exemplarDAO->buscarPeloId($_POST['id']);

        $emprestimo = new Emprestimo('','','','','','');

        $emprestimo->setDataEmprestimo($data);
        $emprestimo->setIdExemplar($_POST['id']);
        $emprestimo->setIdUsuario($usuario->getIdUsuario());
        $emprestimo->setSituacao("Emprestado");

        if($exemplar->getCircular() == "Nao"){
            $emprestimo->setDataDevolucao(date('Y-m-d', strtotime('+1 days')));
        }
        else{
            if($usuario->getIdTipoUsuario() == "1"){
                $emprestimo->setDataDevolucao(date('Y-m-d', strtotime('+10 days')));
            }
            if($usuario->getIdTipoUsuario() == "2"){
                $emprestimo->setDataDevolucao(date('Y-m-d', strtotime('+15 days')));
            }
        }

        $emprestimoDAO = new emprestimoDao();
        $emprestimoDAO->salvar($emprestimo);

        if($emprestimo->getIdEmprestimo() != ""){
            $exemplar->setStatus("Emprestado");
            $exemplarDAO->alterar($exemplar);
            $msg = "Emprestimo realizado com sucesso!";
            echo "<script>window.location.href='../view/exibirEmprestimos.view.php?msg=$msg'</script>";
        }
        else{
            $msg = "Não foi possível realizar o emprestimo!";
            echo "<script>window.location.href='../view/exibirEmprestimos.view.php?msg=$msg'</script>";
        }

        //$devolucao = date('d/m/Y', strtotime('+2 days'));
        //echo $devolucao;
    }
}

if($_GET['act'] == 'dev') {
    if (!empty($_GET['id'])) {
        $emprestimoDAO = new emprestimoDao();
        $emprestimo = $emprestimoDAO->buscarPeloId($_GET['id']);

        $emprestimo->setSituacao("Devolvido");

        $emprestimoDAO->alterar($emprestimo);

        $exemplar = new Exemplar('','','','','','');
        $exemplarDAO = new exemplarDao();
        $exemplar = $exemplarDAO->buscarPeloId($emprestimo->getIdExemplar());

        $exemplar->setStatus("Disponivel");
        $exemplarDAO->alterar($exemplar);

        $msg = "Devolução realizada com sucesso!";
        echo "<script>window.location.href='../view/exibirEmprestimos.view.php?msg=$msg'</script>";
    }
    else{
        $msg = "Erro ao realizar devolução!";
        echo "<script>window.location.href='../view/exibirEmprestimos.view.php?msg=$msg'</script>";
    }
}
