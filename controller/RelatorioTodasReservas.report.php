<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 20:12
 */

require_once ("../dao/livroDao.php");
require_once ("../model/Livro.php");
require_once ("../dao/exemplarDao.php");
require_once ("../model/Exemplar.php");
require_once ("../dao/reservaDao.php");
require_once ("../model/Reserva.php");
require_once ("../model/Usuario.php");
require_once ("../dao/usuarioDao.php");

$reservaDAO = new reservaDao();

$reservas = $reservaDAO->buscarTodos();

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
        <title>Relatório de Todas Reservas no Sistema</title>
    </head>    
    <body>
    <h1>Relatório de Reservas e sua Quantidade</h1>
    <h3>Total de Reservas no Sistema: ".count($reservas)."</h3>
    <h5>Legenda: Tipo de Usuário 1 = Aluno, Tipo de Usuário 2 = Professor, Tipo de Usuário 3 = Funcionário, 
    Tipo de Usuário 4 = Bibliotecário, Tipo de Usuário 5 = Administrador</h5>
    <table>
        <tbody>
            <tr>
                <td>Título</td>
                <td>ISBN</td>
                <td>Autores</td>
                <td>Editora</td>
                <td>Ano</td>
                <td>Data da Reserva</td>
                <td>Usuário</td>
                <td>Tipo Usuário</td>
            </tr>
    ";

foreach ($reservas as $reserva){
    $livroDAO = new livroDao();
    $livro = $livroDAO->buscarPeloId($reserva->idLivro);
    $usuarioDAO = new usuarioDao();
    $usuario = $usuarioDAO->buscarPeloId($reserva->idUsuario);
    $html2 .= "
        <tr>
            <td>".$livro->getTitulo()."</td>
            <td>".$livro->getISBN()."</td>
            <td>".$livro->getAutores()."</td>
            <td>".$livro->getEditora()."</td>
            <td>".$livro->getAno()."</td>
            <td>".date('d-m-Y', strtotime($reserva->dataReserva))."</td>
            <td>".$usuario->getNome()."</td>
            <td>".$usuario->getIdTipoUsuario()."</td>
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