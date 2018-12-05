<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 17:13
 */

session_start();

if(empty($_SESSION['idUsuario']) && empty($_SESSION['tipoUsuario']) && empty($_SESSION['nomeUsuario'])){
    $msg = "É necessário estar logado no sitema para acessar essa página !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

//Segunda verificação de segurança.
if($_SESSION['tipoUsuario'] == "1" || $_SESSION['tipoUsuario'] == "2" || $_SESSION['tipoUsuario'] == "4"){
    $msg = "Atenção: Você não possui autorização para acessar essa área do site !";
    echo "<script>window.location.href='../view/index.php?msg=".$msg."'</script>";
}

require_once ("../view/templateIndex.php");
require_once ("../model/Emprestimo.php");
require_once ("../dao/emprestimoDao.php");

$id = $_GET['exemplar'];

if(!empty($_GET['status'])){
    $status = $_GET['status'];
    $emprestimoDAO = new emprestimoDao();
    $emprestimo = $emprestimoDAO->buscarPeloExemplarEmprestado($id);
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
    <title>WebBook - Reserva</title>

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
                <h2 id="h2CadastroRegistro">Reserva de Exemplar</h2>
                <hr id="hrCadastroRegistro">
                <form method='post' action='../controller/Reserva.action.php?act=save'>
                    <div id="fildsetCadastroRegistro">
                        <fieldset>
                            <legend>Dados do Emprestimo:</legend>
                            <p><?php if(isset($_GET['msg'])){
                                    echo $_GET['msg'];
                                } ?></p>
                            <?php
                                if(!empty($_GET['status'])){
                                    echo"<h3>Próxima Devolução em: ".date('d-m-Y', strtotime($emprestimo->getDataDevolucao()))."</h3>";
                                }
                            ?>
                            <div class="form-row">
                                <input type='hidden' name='id' value='<?= $id ?>'>
                                <div class="form-group col-md-6">
                                    <label for="login">Login do Usuário:</label>
                                    <input type="email" class="form-control" name="login" placeholder="Digite aqui o login do usuário..." required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="login">Data da Reserva:</label>
                                    <?php
                                        if(!empty($_GET['status'])) {
                                            echo "<input type='date' class='form-control' name='dataReserva' required min='".date('Y-m-d', strtotime($emprestimo->getDataDevolucao()))."'>";
                                        }else{
                                            echo "<input type='date' class='form-control' name='dataReserva' required >";
                                        }
                                    ?>

                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <hr id="hrCadastroRegistro">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input id='botaoCadastroRegistro' type='submit' class='btn btn-info' value='RESERVAR'>
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