<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 10/11/2018
 * Time: 20:59
 */

require_once ("../model/Livro.php");
require_once ("../dao/livroDao.php");

if($_GET['act'] == 'save') {
    if (!empty($_POST['titulo']) && !empty($_POST['isbn']) && !empty($_POST['autores'])
    && !empty($_POST['edicao']) && !empty($_POST['editora']) && !empty($_POST['ano']) && !empty($_POST['categoria'])) {
        try {
            $livro = new Livro('','','','','','','','','');
            $livro->setTitulo($_POST['titulo']);
            $livro->setISBN($_POST['isbn']);
            $livro->setAutores($_POST['autores']);
            $livro->setEdicao($_POST['edicao']);
            $livro->setEditora($_POST['editora']);
            $livro->setAno($_POST['ano']);
            $livro->setIdCategoria($_POST['categoria']);
            $livro->setCapa($_FILES['capa']['name']);

            $dao = new livroDao();
            $dao->salvar($livro);

            $id = $livro->getIdLivro();

            mkdir("../imagens/livros/".$livro->getIdLivro()."");

            move_uploaded_file($_FILES['capa']['tmp_name'], "../imagens/livros/$id/".$_FILES['capa']['name']);

            $msg = "Registro realizado com sucesso!";
            echo "<script>window.location.href='../view/exibirLivro.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao salvar: " . $erro->getMessage();
            echo "<script>window.location.href='../view/cadastroLivro.view.php?msg=$msg'</script>";
        }

    } else {
        $msg = "Erro: preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/cadastroLivro.view.php?msg=$msg'</script>";
    }
}

if($_GET['act'] == 'updt') {
    if (!empty($_POST['titulo']) && !empty($_POST['isbn']) && !empty($_POST['autores'])
        && !empty($_POST['edicao']) && !empty($_POST['editora']) && !empty($_POST['ano'])
        && !empty($_POST['categoria']) && !empty($_POST['id'])) {
        try {
            $livro = new Livro('','','','','','','','','');

            $dao = new livroDao();
            $livro = $dao->buscarPeloId($_POST['id']);

            $livro->setTitulo($_POST['titulo']);
            $livro->setISBN($_POST['isbn']);
            $livro->setAutores($_POST['autores']);
            $livro->setEdicao($_POST['edicao']);
            $livro->setEditora($_POST['editora']);
            $livro->setAno($_POST['ano']);
            $livro->setIdCategoria($_POST['categoria']);

            if($_FILES['capa']['name'] != null){
                $livro->setCapa($_FILES['capa']['name']);
                $id = $livro->getIdLivro();
                move_uploaded_file($_FILES['capa']['tmp_name'], "../imagens/livros/$id/".$_FILES['capa']['name']);
            }

            $dao->alterar($livro);

            $msg = "Registro alterado com sucesso!";
            echo "<script>window.location.href='../view/exibirLivro.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao alterar: " . $erro->getMessage();
            echo "<script>window.location.href='../view/cadastroLivro.view.php?msg=$msg'</script>";
        }

    } else {
        $msg = "Erro: preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/cadastroLivro.view.php?msg=$msg'</script>";
    }
}

if($_GET['act'] == 'del') {
    if (!empty($_GET['id'])) {
        try {
            $livro = new Livro('','','','','','','','','');
            $dao = new livroDao();
            $livro = $dao->buscarPeloId($_GET["id"]);

            $dao->apagar($livro);

            $msg = "Registro removido com sucesso!";
            echo "<script>window.location.href='../view/exibirLivro.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao excluir: " . $erro->getMessage();
            echo "<script>window.location.href='../view/exibirLivro.view.php?msg=$msg'</script>";
        }
    } else {
        $msg = "Erro: o identificador do registro está vazio ou nulo!";
        echo "<script>window.location.href='../view/exibirLivro.view.php?msg=$msg'</script>";
    }
}