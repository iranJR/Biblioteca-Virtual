<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 31/10/2018
 * Time: 19:01
 */
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet" href="../css/estiloLogin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../javaScript/meuJS.js"></script>
    <title>WebBook - Login</title>

</head>
<body>

<div id="divLogin" class="col-sm-4">
    <form>
        <h1>Bem vindo a WebBook</h1>
        <h3>Sua biblioteca virtual</h3>
        <hr>
        <h3>Faça agora o seu login</h3>
        <div class="form-group">
            <label for="exampleInputEmail1">Login:</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite aqui o seu e-mail...">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Senha:</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Digite aqui sua senha...">
        </div>
        <button id="botaoLogin" type="submit" class="btn btn-info">Entrar</button>
    </form>
</div>

</body>
</html>

