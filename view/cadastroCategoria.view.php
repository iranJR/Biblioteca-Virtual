<?php
/**
 * Created by PhpStorm.
 * User: iran
 * Date: 09/11/2018
 * Time: 14:26
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
require_once ("../model/Categoria.php");
require_once ("../dao/categoriaDao.php");


if(!empty($_GET['id'])){
    $id = $_GET['id'];

    $dao = new categoriaDao();
    $categoria = new Categoria('','','','');
    $categoria = $dao->buscarPeloId($id);
}else{
    $id = "";
    $categoria = new Categoria('','','','');
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
            <h2 id="h2CadastroRegistro">Cadastro de Categoria</h2>
            <hr id="hrCadastroRegistro">
            <?php
                if(!empty($_GET['id'])) {
                    echo "<form method='post' action='../controller/Categoria.action.php?act=updt'>";
                }else{
                    echo "<form method='post' action='../controller/Categoria.action.php?act=save'>";
                }
            ?>
                <div id="fildsetCadastroRegistro">
                <fieldset>
                    <legend>Dados Gerais:</legend>
                    <p><?php if(isset($_GET['msg'])){
                        echo $_GET['msg'];
                        } ?></p>
                    <div class="form-row">
                        <input type='hidden' name='id' value='<?= $categoria->getIdCategoria() ?>'>
                        <div class="form-group col-md-6">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" placeholder="Digite aqui o nome..." required value="<?= $categoria->getNome() ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="descricao">Descrição:</label>
                            <input type="text" class="form-control" name="descricao" placeholder="Digite aqui a descrição..." required value="<?= $categoria->getDescricaoCategoria() ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="assunto">Assunto:</label>
                            <input type="text" class="form-control cpf" name="assunto" placeholder="Digite aqui o assunto..." required value="<?= $categoria->getAssunto() ?>">
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