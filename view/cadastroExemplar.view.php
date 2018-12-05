<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 04/12/2018
 * Time: 13:29
 */

session_start();

if(empty($_SESSION['idUsuario']) && empty($_SESSION['tipoUsuario']) && empty($_SESSION['nomeUsuario'])){
    $msg = "É necessário estar logado no sitema para acessar essa página !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

//Segunda verificação de segurança.
if($_SESSION['tipoUsuario'] == "1" || $_SESSION['tipoUsuario'] == "2" || $_SESSION['tipoUsuario'] == "3"){
    $msg = "Atenção: Você não possui autorização para acessar essa área do site !";
    echo "<script>window.location.href='../view/index.php?msg=".$msg."'</script>";
}

require_once ("../view/templateIndex.php");
require_once ("../model/Exemplar.php");
require_once ("../dao/exemplarDao.php");
require_once ("../model/Livro.php");
require_once ("../dao/livroDao.php");

if(!empty($_GET['id'])){
    $id = $_GET['id'];

    $exemplarDAO = new exemplarDao();
    $exemplar = new Exemplar('','','','','','');
    $exemplar = $exemplarDAO->buscarPeloId($id);

    $livro = new Livro('','','','','','','','','');

    $livroDAO = new livroDao();
    $livro = $livroDAO->buscarPeloId($exemplar->getIdLivro());

}else{
    $id = "";
    $exemplar = new Exemplar('','','','','','');

    $idLivro = $_GET['livro'];
    $livro = new Livro('','','','','','','','','');

    $livroDAO = new livroDao();
    $livro = $livroDAO->buscarPeloId($idLivro);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../javaScript/acaoExemplar.js"></script>
    <title>WebBook - Cadastro</title>

</head>
<body>

<?php
cabecalho();
?>

<div id="conteudoPrincipalFixo" class="container-fluid text-center">
    <div class="row content">

        <?php
        if($_SESSION['tipoUsuario'] == "1" || $_SESSION['tipoUsuario'] == "2"){
            menuLateralUsuario();
        }
        if($_SESSION['tipoUsuario'] == "3"){
            menuLateralFuncionario();
        }
        if($_SESSION['tipoUsuario'] == "4"){
            menuLateralBibliotecario();
        }
        if($_SESSION['tipoUsuario'] == "5"){
            menuLateralAdmin();
        }
        ?>

        <!--Conteudo Principal-->
        <div id="conteudoPrincipal" class="col-md-10 text-left">

            <!--Formulário de Cadastro-->
            <div id="DivCadastroRegistro" class="container col-md-12">
                <h2 id="h2CadastroRegistro">Cadastro de Exemplar</h2>
                <hr id="hrCadastroRegistro">
                <?php
                if(!empty($_GET['id'])) {
                    echo "<form method='post' action='../controller/Exemplar.action.php?act=updt' enctype='multipart/form-data'>";
                }else{
                    echo "<form method='post' action='../controller/Exemplar.action.php?act=save' enctype='multipart/form-data'>";
                }
                ?>
                <div id="fildsetCadastroRegistro">
                    <fieldset>
                        <legend>Dados Gerais:</legend>
                        <p><?php if(isset($_GET['msg'])){
                                echo $_GET['msg'];
                            } ?></p>
                        <div class="form-row">
                            <input type="hidden" name="id" value="<?= $exemplar->getIdExemplar() ?>">
                            <input type="hidden" name="idLivro" value="<?= $livro->getIdLivro() ?>">
                            <div class="form-group col-md-6">
                                <img src='../imagens/livros/<?= $livro->getIdLivro() ?>/<?= $livro->getCapa() ?>' alt="Capa do Livro" width="100px">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" name="titulo" disabled value="<?= $livro->getTitulo() ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="circular">Circular:</label>
                                <?php
                                    if($exemplar->getCircular() == "Sim"){
                                        echo"<label class='radio-inline'><input type='radio' name='circular' value='Nao' > Não</label>
                                            <label class='radio-inline'><input type='radio'name='circular' value='Sim' checked> Sim</label>";
                                    }else{
                                        echo"<label class='radio-inline'><input type='radio' name='circular' value='Nao' checked> Não</label>
                                            <label class='radio-inline'><input type='radio' name='circular' value='Sim'> Sim</label>";
                                    }
                                ?>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="circular">Tipo do Exemplar:</label>
                                <?php
                                    if($exemplar->getTipo() == "Digital"){
                                        echo"<label class='radio-inline'><input type='radio' name='tipoExemplar' value='Fisico' > Físico</label>
                                        <label class='adio-inline'><input type='radio' name='tipoExemplar' value='Digital' checked> Digital</label>";
                                    }else{
                                        echo"<label class='radio-inline'><input type='radio' name='tipoExemplar' value='Fisico' checked> Físico</label>
                                        <label class='radio-inline'><input type='radio' name='tipoExemplar' value='Digital'> Digital</label>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div id="arquivoDigital" class="form-row">
                            <div class="form-group col-md-6">
                                <label for="arquivo">Adicione o arquivo digital</label>
                                <input type="file" name="arquivo"><br>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <hr id="hrCadastroRegistro">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <?php
                        if(!empty($_GET['id'])){
                            echo"<input id='botaoCadastroRegistro' type='submit' class='btn btn-info' value='ALTERAR'>";
                        }
                        else{
                            echo"<input id='botaoCadastroRegistro' type='submit' class='btn btn-info' value='CADASTRAR'>";
                        }
                        ?>
                    </div>
                </div>
                </form>

                <!--Fim Formulário de Cadastro-->
            </div>
        </div>
        <!--Fim Conteudo Principal-->

    </div>
</div>
<br>

<?php
rodapePagPequena();
?>

</body>
</html>