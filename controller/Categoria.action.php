<?php

/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 09/11/2018
 * Time: 14:49
 */

require_once ("../model/Categoria.php");
require_once ("../dao/categoriaDao.php");

if($_GET['act'] == 'save') {
    if (!empty($_POST['nome']) && !empty($_POST['descricao']) && !empty($_POST['assunto'])) {
        try {
            $categoria = new Categoria('', '', '', '');
            $categoria->setNome($_POST['nome']);
            $categoria->setDescricaoCategoria($_POST['descricao']);
            $categoria->setAssunto($_POST['assunto']);

            $dao = new categoriaDao();
            $dao->salvar($categoria);

            $msg = "Registro realizado com sucesso!";
            echo "<script>window.location.href='../view/exibirCategoria.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao salvar: " . $erro->getMessage();
            echo "<script>window.location.href='../view/cadastroCategoria.view.php?msg=$msg'</script>";
        }

    } else {
        $msg = "Erro: preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/cadastroCategoria.view.php?msg=$msg'</script>";
    }
}

if($_GET['act'] == 'updt') {
    if (!empty($_POST['nome']) && !empty($_POST['descricao']) &&
        !empty($_POST['assunto']) && !empty($_POST['id'])) {
        try {
            $categoria = new Categoria('', '', '', '');
            $dao = new categoriaDao();
            $categoria = $dao->buscarPeloId($_POST["id"]);

            $categoria->setNome($_POST['nome']);
            $categoria->setDescricaoCategoria($_POST['descricao']);
            $categoria->setAssunto($_POST['assunto']);

            $dao->alterar($categoria);

            $msg = "Registro alterado com sucesso!";
            echo "<script>window.location.href='../view/exibirCategoria.view.php?msg=$msg'</script>";
            echo"Alterou";
        } catch (PDOException $erro) {
            $msg = "Erro ao alterar: " . $erro->getMessage();
            echo "<script>window.location.href='../view/cadastroCategoria.view.php?msg=$msg'</script>";
        }
    } else {
        $msg = "Erro: preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/cadastroCategoria.view.php?msg=$msg'</script>";
    }
}

if($_GET['act'] == 'del') {
    if (!empty($_GET['id'])) {
        try {
            $categoria = new Categoria('', '', '', '');
            $dao = new categoriaDao();
            $categoria = $dao->buscarPeloId($_GET["id"]);

            $dao->apagar($categoria);

            $msg = "Registro removido com sucesso!";
            echo "<script>window.location.href='../view/exibirCategoria.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao excluir: " . $erro->getMessage();
            echo "<script>window.location.href='../view/exibirCategoria.view.php?msg=$msg'</script>";
        }
    } else {
        $msg = "Erro: o identificador do registro está vazio ou nulo!";
        echo "<script>window.location.href='../view/exibirCategoria.view.php?msg=$msg'</script>";
    }
}

