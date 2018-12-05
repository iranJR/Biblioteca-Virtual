<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 04/12/2018
 * Time: 09:54
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
require_once ("../model/Usuario.php");
require_once ("../dao/usuarioDao.php");

    $id = "";
    $usuario = new Usuario('','','','','','');

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
                <h2 id="h2CadastroRegistro">Cadastro de Usuário</h2>
                <hr id="hrCadastroRegistro">
                <form method='post' action='../controller/Usuario.action.php?act=save'>
                <div id="fildsetCadastroRegistro">
                    <fieldset>
                        <legend>Dados Gerais:</legend>
                        <p><?php if(isset($_GET['msg'])){
                                echo $_GET['msg'];
                            } ?></p>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" name="nome" placeholder="Digite aqui o nome..." required >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cpf">CPF:</label>
                                <input type="text" class="form-control" name="cpf" placeholder="Digite aqui o seu cpf..." required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="login">Login:</label>
                                <input type="email" class="form-control" name="login" placeholder="Digite aqui o login..." required >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="senha">Senha:</label>
                                <input type="password" class="form-control" name="senha" placeholder="Digite aqui a senha..." required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tipoUsuario">Tipo de Usuário</label>
                                <select class="form-control" id="tipoUsuario" name="tipoUsuario" required >
                                    <option disabled selected>Selecione o tipo de usuário...</option>
                                    <?php

                                    if($_SESSION['tipoUsuario'] == "5") {
                                        echo"
                                        <option value = '1' name = 'Aluno' > Aluno</option >
                                        <option value = '2' name = 'Professor' > Professor</option >
                                        <option value = '3' name = 'Funcionário' > Funcionário</option >
                                        <option value = '4' name = 'Bibliotecário' > Bibliotecário</option >
                                        <option value = '5' name = 'Administrador' > Administrador</option >";
                                    }

                                    if($_SESSION['tipoUsuario'] == "3") {
                                        echo"
                                        <option value = '1' name = 'Aluno' > Aluno</option >
                                        <option value = '2' name = 'Professor' > Professor</option >";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <hr id="hrCadastroRegistro">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <input id='botaoCadastroRegistro' type='submit' class='btn btn-info' value='CADASTRAR'>
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