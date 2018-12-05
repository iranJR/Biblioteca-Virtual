<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 20:32
 */

session_start();

//Verificação de segurança.
if(empty($_SESSION['idUsuario']) && empty($_SESSION['tipoUsuario']) && empty($_SESSION['nomeUsuario'])){
    $msg = "É necessário estar logado no sitema para acessar essa página !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

//Segunda verificação de segurança.
if($_SESSION['tipoUsuario'] == "1" || $_SESSION['tipoUsuario'] == "2" || $_SESSION['tipoUsuario'] == "4" || $_SESSION['tipoUsuario'] == "3"){
    $msg = "Atenção: Você não possui autorização para acessar essa área do site !";
    echo "<script>window.location.href='../view/index.php?msg=".$msg."'</script>";
}

require_once ("../view/templateIndex.php");
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
    <script src="../javaScript/meuJS.js"></script>
    <title>WebBook - Relatórios</title>

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



        <div id="divIndexImg" class="col-md-10 text-left">
            <div id='divLogin' class="col-sm-6" style="text-align: center; color: white;">
                <h1 style="font-variant: small-caps">Lista de Relatórios do Sistema</h1>
                <hr/>
                <h2>Relatórios Gerados</h2>
                <br/>
                <br/>
                <h4><?php if(isset($_GET['msg'])){
                        echo $_GET['msg'];
                        echo"<br/>";
                    } ?></h4>
                <form>
                    <div class="form-row">
                        <div class="col-md-6">
                            <a class='btn btn-info' id="botaoLogin" style="width: 90%" href="../controller/RelatorioTodosEmprestimos.report.php">Relatório Emprestimos</a>
                        </div>
                        <div class="col-md-6">
                            <a class='btn btn-info' id="botaoLogin" style="width: 90%" href="../controller/RelatorioTodasReservas.report.php">Relatório Reservas</a>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-row">
                        <div class="col-md-6">
                            <a class='btn btn-info' id="botaoLogin" style="width: 90%" href="../controller/RelatorioTodosUsuarios.report.php">Relatório Usuários</a>
                        </div>
                        <div class="col-md-6">
                            <a class='btn btn-info' id="botaoLogin" style="width: 90%" href="../controller/RelatorioTodosLivrosExemplares.report.php">Relatório Livros</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <!--Fim Conteudo Principal-->

    </div>
</div>
<br>

<?php
rodape();
?>

</body>
</html>