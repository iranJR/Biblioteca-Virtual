<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 19:27
 */

require_once ("../dao/livroDao.php");
require_once ("../model/Livro.php");
require_once ("../dao/exemplarDao.php");
require_once ("../model/Exemplar.php");

$livroDAO = new livroDao();

$livros = $livroDAO->buscarTodos();

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
        <title>Relatório de Todos Livros e Exemplares no Sistema</title>
    </head>    
    <body>
    <h1>Relatório dos Livros e sua Quantidade de Exemplares</h1>
    <h3>Total de Livros no Sistema: ".count($livros)."</h3>
    <table>
        <tbody>
            <tr>
                <td>Título</td>
                <td>ISBN</td>
                <td>Autores</td>
                <td>Editora</td>
                <td>Ano</td>
                <td>Exemplares</td>
            </tr>
    ";

foreach ($livros as $livro){
    $exemplarDAO = new exemplarDao();
    $exemplares = $exemplarDAO->buscarTodosPorLivro($livro->idLivro);

    $html2 .= "
        <tr>
            <td>".$livro->titulo."</td>
            <td>".$livro->ISBN."</td>
            <td>".$livro->autores."</td>
            <td>".$livro->editora."</td>
            <td>".$livro->ano."</td>
            <td>".count($exemplares)."</td>
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



