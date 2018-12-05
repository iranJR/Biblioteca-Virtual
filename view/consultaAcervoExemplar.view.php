<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 01:02
 */

session_start();

if(empty($_SESSION['idUsuario']) && empty($_SESSION['tipoUsuario']) && empty($_SESSION['nomeUsuario'])){
    $msg = "É necessário estar logado no sitema para acessar essa página !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

require_once ("../view/templateIndex.php");
require_once ('../banco/conexao_bd.php');

global $pdo;

$idLivro = $_GET['livro'];

/*endereço atual da página*/
$endereco = $_SERVER ['PHP_SELF'];

/* Constantes de configuração*/
define('QTDE_REGISTROS', 3);
define('RANGE_PAGINAS', 1);

/* Recebe o número da página via parâmetro na URL*/
$pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

/* Calcula a linha inicial da consulta*/
$linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;

/* Instrução de consulta para paginação com MySQL*/

$sql = "SELECT * FROM livro, exemplar where livro.idLivro = exemplar.idLivro AND livro.idLivro = :id LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
$statement = $pdo->prepare($sql);
$statement->bindValue(":id", $idLivro);

$statement->execute();
$dados = $statement->fetchAll(PDO::FETCH_OBJ);

/* Conta quantos registos existem na tabela*/

$sqlContador = "SELECT COUNT(*) AS total_registros FROM livro, exemplar where livro.idLivro = exemplar.idLivro AND livro.idLivro = :id";
$statement = $pdo->prepare($sqlContador);
$statement->bindValue(":id", $idLivro);

$statement->execute();
$valor = $statement->fetch(PDO::FETCH_OBJ);

/* Idêntifica a primeira página*/
$primeira_pagina = 1;

/* Cálcula qual será a última página*/
$ultima_pagina = ceil($valor->total_registros / QTDE_REGISTROS);

/* Cálcula qual será a página anterior em relação a página atual em exibição*/
$pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : $pagina_atual;

/* Cálcula qual será a pŕoxima página em relação a página atual em exibição*/
$proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : $pagina_atual;

/* Cálcula qual será a página inicial do nosso range*/
$range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;

/* Cálcula qual será a página final do nosso range*/
$range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

/* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo"*/
$exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

/* Verifica se vai exibir o botão "Anterior" e "Último"*/
$exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';
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
    <title>WebBook - Exemplar</title>

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


            <!-- Inicio da Div Central -->

            <div id="DivRegistroTabela" class="container col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Consulta de Exemplares do Acervo</h1>
                        <hr id="hrRegistros">
                        <p id="msgExibirRegistro"><?php if(isset($_GET['msg'])){
                                echo $_GET['msg'];
                                echo"   <span class='glyphicon glyphicon-asterisk'></span>";
                            } ?></p>
                        <div id="tabelaExibir" class="row">
                            <table class="table table-hover">
                                <thead id="theadRegistro">
                                <tr>
                                    <th>Livro</th>
                                    <th>Título</th>
                                    <th>Exemplar</th>
                                    <th>Circular</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <?php
                                    if($_SESSION['tipoUsuario'] == "3" || $_SESSION['tipoUsuario'] == "5"){
                                        echo"
                                        <td>Emprestar</td>
                                        ";
                                    }
                                    ?>
                                </tr>
                                </thead>
                                <tbody id="tbodyRegistro">
                                <?php if (!empty($dados)) {

                                foreach ($dados as $livro) {
                                    if($livro->capa == null || $livro->capa == ""){
                                        echo "
                                        <tr>                        
                                        <td><img src='../imagens/livros/capaLivroPadrao.gif' width='60px'></td>";
                                    }
                                    else{
                                        echo "
                                        <tr>                        
                                        <td><img src='../imagens/livros/".$livro->idLivro."/".$livro->capa. "' width='60px'></td>";
                                    }

                                    echo "
                        <td>$livro->titulo</td>
                        <td>$livro->idExemplar</td>
                        <td>$livro->circular</td>
                        <td>$livro->tipo</td>
                        <td>$livro->status</td>";
                        if($_SESSION['tipoUsuario'] == "3" || $_SESSION['tipoUsuario'] == "5"){
                            if($livro->status == "Disponivel"){
                                echo"
                                <td><a href='emprestimoUsuario.view.php?exemplar=".$livro->idExemplar."'><i class='glyphicon glyphicon-plus-sign'></i>  Emprestar</a></td>
                                ";
                            }else{
                                echo "Indisponível";
                            }
                        }
                    echo"</tr>                    
                    ";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Fim da Div Central -->

                    <nav id='Paginacao' aria-label='Navegacao' class="col-md-10">
                        <ul id='UlPaginacao' class='pagination pagination-md'>
                            <li class='page-item'>

                                <?php
                                if(!empty($_GET['busca'])) {
                                    echo "<a class='page-link $exibir_botao_inicio' href='$endereco?page=$primeira_pagina&busca=$busca' title='Primeira Página'>&laquo; Primeira  </a>";
                                }else{
                                    echo "<a class='page-link $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'>&laquo; Primeira  </a>";
                                }

                                ?>
                            </li>
                            <li class='page-item'>
                                <?php
                                if(!empty($_GET['busca'])) {
                                    echo"<a class='page-link $exibir_botao_inicio' href='$endereco?page=$pagina_anterior&busca=$busca' title='Página Anterior'>‹ Anterior  </a>";
                                }else{
                                    echo"<a class='page-link $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'>‹ Anterior  </a>";
                                }
                                ?>
                            </li>
                            <?php
                            /* Loop para montar a páginação central com os números*/
                            for ($i = $range_inicial; $i <= $range_final; $i++):
                                $destaque = ($i == $pagina_atual) ? 'destaque' : '';
                                echo "
                <li class='page-item'>";
                                if(!empty($_GET['busca'])) {
                                    echo "<a class='page-link $destaque' href='$endereco?page=$i&busca=$busca'>  $i  </a>";
                                }else{
                                    echo "<a class='page-link $destaque' href='$endereco?page=$i'>  $i  </a>";
                                }


                                echo"</li>";
                            endfor;
                            ?>

                            <li class='page-item'>
                                <?php
                                if(!empty($_GET['busca'])) {
                                    echo"<a class='page-link $exibir_botao_final' href='$endereco?page=$proxima_pagina&busca' title='Próxima Página'> Próxima ›</a>";
                                }else{
                                    echo"<a class='page-link $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'> Próxima ›</a>";
                                }
                                ?>
                            </li>
                            <li class='page-item'>
                                <?php
                                if(!empty($_GET['busca'])) {
                                    echo"<a class='page-link $exibir_botao_final' href='$endereco?page=$ultima_pagina&busca'  title='Última Página'> Última &raquo;</a>";
                                }else{
                                    echo"<a class='page-link $exibir_botao_final' href='$endereco?page=$ultima_pagina'  title='Última Página'> Última &raquo;</a>";
                                }
                                ?>
                            </li>
                        </ul>
                    </nav>
                    <?php
                    }
                    else {
                        echo "<h2 class='bg-warning'>Nenhum registro foi encontrado!</h2>
    ";
                    }



                    ?>
                    <!--Fim da Div Central -->

                </div>
                <!--Fim Conteudo Principal-->
            </div>
        </div>
    </div>
</div>
<br>


<?php
rodapePagPequena();
?>

</body>
</html>