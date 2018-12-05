<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 04/12/2018
 * Time: 14:26
 */

require_once ("../model/Exemplar.php");
require_once ("../dao/exemplarDao.php");

if($_GET['act'] == 'save') {
    if (!empty($_POST['idLivro']) && !empty($_POST['circular']) && !empty($_POST['tipoExemplar'])) {
        try {
            $exemplar = new Exemplar('','','','','','');
            $exemplar->setIdLivro($_POST['idLivro']);
            $exemplar->setCircular($_POST['circular']);
            $exemplar->setTipo($_POST['tipoExemplar']);
            $exemplar->setStatus("Disponivel");

            if($_POST['tipoExemplar'] == "Digital"){
                $exemplar->setArquivoDigital($_FILES['arquivo']['name']);
            }

            $dao = new exemplarDao();
            $dao->salvar($exemplar);

            if($_POST['tipoExemplar'] == "Digital") {
                $id = $exemplar->getIdExemplar();

                mkdir("../arquivos/exemplar/" . $exemplar->getIdExemplar() . "");

                move_uploaded_file($_FILES['arquivo']['tmp_name'], "../arquivos/exemplar/$id/" . $_FILES['arquivo']['name']);

            }

            $msg = "Registro realizado com sucesso!";
            echo "<script>window.location.href='../view/exibirLivroExemplar.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao salvar: " . $erro->getMessage();
            echo "<script>window.location.href='../view/cadastroExemplar.view.php?msg=$msg'</script>";
        }

    } else {
        $msg = "Erro: preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/cadastroExemplar.view.php?msg=$msg'</script>";
    }
}

if($_GET['act'] == 'updt') {
    if (!empty($_POST['idLivro']) && !empty($_POST['circular']) && !empty($_POST['tipoExemplar'])) {
        try {
            $exemplar = new Exemplar('','','','','','');

            $dao = new exemplarDao();
            $exemplar = $dao->buscarPeloId($_POST['id']);

            $exemplar->setIdLivro($_POST['idLivro']);
            $exemplar->setCircular($_POST['circular']);
            $exemplar->setTipo($_POST['tipoExemplar']);
            $exemplar->setStatus("Disponivel");

            if($_POST['tipoExemplar'] == "Digital"){
                if($_FILES['arquivo']['name'] != null) {
                    $exemplar->setArquivoDigital($_FILES['arquivo']['name']);
                    $id = $exemplar->getIdExemplar();
                    move_uploaded_file($_FILES['arquivo']['tmp_name'], "../arquivos/exemplar/$id/" . $_FILES['arquivo']['name']);
                }
            }else{
                $exemplar->setArquivoDigital('');
            }

            $dao->alterar($exemplar);

            $msg = "Registro alterado com sucesso!";
            echo "<script>window.location.href='../view/exibirLivroExemplar.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao alterar: " . $erro->getMessage();
            echo "<script>window.location.href='../view/exibirLivroExemplar.view.php?msg=$msg'</script>";
        }

    } else {
        $msg = "Erro: preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/exibirLivroExemplar.view.php?msg=$msg'</script>";
    }
}

if($_GET['act'] == 'del') {
    if (!empty($_GET['id'])) {
        try {
            $exemplar = new Exemplar('','','','','','');
            $dao = new exemplarDao();
            $exemplar = $dao->buscarPeloId($_GET["id"]);

            $dao->apagar($exemplar);

            $msg = "Registro removido com sucesso!";
            echo "<script>window.location.href='../view/exibirLivroExemplar.view.php?msg=$msg'</script>";
        } catch (PDOException $erro) {
            $msg = "Erro ao excluir: " . $erro->getMessage();
            echo "<script>window.location.href='../view/exibirLivroExemplar.view.php?msg=$msg'</script>";
        }
    } else {
        $msg = "Erro: o identificador do registro está vazio ou nulo!";
        echo "<script>window.location.href='../view/exibirLivroExemplar.view.php?msg=$msg'</script>";
    }
}