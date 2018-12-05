<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 19:49
 */

require_once ("../dao/usuarioDao.php");
require_once ("../model/Usuario.php");

$usuarioDAO = new usuarioDao();

$usuarios = $usuarioDAO->buscarTodos();

$css="
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid black;
        text-align: left;
        padding: 8px;
    }

</style>";

$html="
<html>
    <head>
        <title>Relatório de Todos Usuários no Sistema</title>
    </head>    
    <body>
    <h1>Relatório dos Usuários no Sistema</h1>
    <h3>Total de Usuários no Sistema: ".count($usuarios)."</h3>
    <h5>Legenda: Tipo de Usuário 1 = Aluno, Tipo de Usuário 2 = Professor, Tipo de Usuário 3 = Funcionário, 
    Tipo de Usuário 4 = Bibliotecário, Tipo de Usuário 5 = Administrador</h5>
    <table>
        <tbody>
            <tr>
                <td>Nome</td>
                <td>CPF</td>
                <td>Login</td>
                <td>Tipo de Usuário</td>
            </tr>
    ";

foreach ($usuarios as $usuario){

    $html2 .= "
        <tr>
            <td>".$usuario->nome."</td>
            <td>".$usuario->cpf."</td>
            <td>".$usuario->login."</td>
            <td>".$usuario->idTipoUsuario."</td>
        </tr>
    ";
}

$html2 .= "
    </tbody>
    </table>
    </body>
    </html>
";

use Mpdf\Mpdf;
require_once ("../vendor/autoload.php");
$mpdf = new Mpdf();
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->WriteHTML($html2,3);
$mpdf->Output("Relatório.pdf","I");