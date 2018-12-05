<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 05/12/2018
 * Time: 18:59
 */

session_start();

if(empty($_SESSION['idUsuario']) && empty($_SESSION['tipoUsuario']) && empty($_SESSION['nomeUsuario'])){
    $msg = "É necessário estar logado no sitema para acessar essa página !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

require_once ("../view/templateIndex.php");
require_once ('../banco/conexao_bd.php');

if(!empty($_GET['busca'])){
    $busca = $_GET['busca'];
}

$idUsuario = $_SESSION['idUsuario'];

global $pdo;

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
if(!empty($_GET['busca'])) {
    $sql = "SELECT * FROM reserva, livro, usuario where reserva.idLivro = livro.idLivro AND reserva.idUsuario = usuario.idUsuario AND usuario.idUsuario = :id AND livro.titulo like :busca LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':busca', '%' . $busca . '%');
    $statement->bindValue(':id', $idUsuario);
}else{
    $sql = "SELECT * FROM reserva, livro, usuario where reserva.idLivro = livro.idLivro AND reserva.idUsuario = usuario.idUsuario AND usuario.idUsuario = :id LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $idUsuario);
}
$statement->execute();
$dados = $statement->fetchAll(PDO::FETCH_OBJ);

/* Conta quantos registos existem na tabela*/
if(!empty($_GET['busca'])) {
    $sqlContador = "SELECT COUNT(*) AS total_registros FROM reserva, livro, usuario where reserva.idLivro = livro.idLivro AND reserva.idUsuario = usuario.idUsuario AND usuario.idUsuario = :id AND livro.titulo like :busca";
    $statement = $pdo->prepare($sqlContador);
    $statement->bindValue(':busca', '%' . $busca . '%');
    $statement->bindValue(':id', $idUsuario);
}else{
    $sqlContador = "SELECT COUNT(*) AS total_registros FROM reserva, livro, usuario where reserva.idLivro = livro.idLivro AND reserva.idUsuario = usuario.idUsuario AND usuario.idUsuario = :id";
    $statement = $pdo->prepare($sqlContador);
    $statement->bindValue(':id', $idUsuario);
}
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


            <!-- Inicio da Div Central -->

            <div id="DivRegistroTabela" class="container col-md-12">
                <div class="row">
                    <!--Form de busca de registros-->
                    <form method="get">
                        <div class="container col-md-8">
                            <div class="form-row">
                                <div id="buscarRegistro" class='input-group'>
                                    <input id='busca' name="busca" type='text' class='form-control' placeholder='Buscar reserva...'>
                                    <div class='input-group-btn'>
                                        <button id='BotaoPesquisar' class='btn btn-warning' type='submit'>
                                            <i class='glyphicon glyphicon-search'></i>  BUSCAR
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br/>
                    <!--Fim do form de busca de registros-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h1>Minhas Reservas</h1>
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
                                    <th>Data Reserva</th>
                                    <th>Usuário</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody id="tbodyRegistro">
                                <?php if (!empty($dados)) {

                                foreach ($dados as $reserva) {
                                    if($reserva->capa == null || $reserva->capa == ""){
                                        echo "
                                        <tr>                        
                                        <td><img src='../imagens/livros/capaLivroPadrao.gif' width='60px'></td>";
                                    }
                                    else{
                                        echo "
                                        <tr>                        
                                        <td><img src='../imagens/livros/".$reserva->idLivro."/".$reserva->capa. "' width='60px'></td>";
                                    }

                                    echo "
                        <td>$reserva->titulo</td>
                        <td>".date('d-m-Y', strtotime($reserva->dataReserva))."</td>
                        <td>$reserva->nome</td>
                        <td><a  data-toggle='modal' data-target='#myModal".$reserva->idReserva."' id='tdRemover' href='#?id=".$reserva->idReserva."'><i class='glyphicon glyphicon-remove'></i>  Cancelar Reserva</a></td>
                    </tr>
                    <!-- Modal -->
                    <div id='myModal".$reserva->idReserva."' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
        
                            <!-- Modal content-->
                            <div class='modal-content'>
                                <div id='cabecalhoModal' class='modal-header'>
                                    <button id='fecharModal' type='button' class='close' data-dismiss='modal'>&times;</button>
                                    <h4 class='modal-title'>Confirmação de Cancelamento</h4>
                                </div>
                                <div id='bodyModal' class='modal-body'>
                                    <p>Confirmar o cancelamento de reserva ?</p>
                                </div>
                                <div id='rodapeModal' class='modal-footer'>
                                    <a id='aBotaoRemover' class='btn btn-warning' href='../controller/Reserva.action.php?act=del&id=".$reserva->idReserva."'>Cancelar</a>
                                    <button id='aBotaoCancelar' type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
                                </div>
                            </div>
                            <!-- Fim Modal Content -->
                        </div>
                    </div>
                    <!-- Fim Modal -->
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
rodape();
?>

</body>
</html>