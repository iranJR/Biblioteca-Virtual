<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 31/10/2018
 * Time: 21:16
 */

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
        <title>WebBook - Páginal Inicial</title>

    </head>
    <body>

    <?php
        cabecalho();
    ?>

        <div id="conteudoPrincipalFixo" class="container-fluid text-center">
            <div class="row content">

                <?php
                    menuLateral();
                ?>

                <!--Conteudo Principal-->
                <div id="conteudoPrincipal" class="col-sm-8 text-left">
                    <h1>Master Page</h1>
                    <p>Conteudo principal</p>
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
