<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 31/10/2018
 * Time: 21:02
 */


function cabecalho()
{
    echo"
    <!--Cabeçalho-->
    <nav id = 'cabecalho' class='navbar navbar-inverse' >
        <div class='container-fluid' >
            <div class='navbar-header' >
                <a id = 'linkLogo' href = '#' >
                    <img id = 'imgLogo' src = '../imagens/logoSite.png' >
    WebBook</a >
            </div >
            <ul id = 'iconesCabecalho' class='nav navbar-nav navbar-right' >
                <li ><a href = '#' ><span class='glyphicon glyphicon-user' ></span > Cadastrar</a ></li >
                <li ><a href = '#' ><span class='glyphicon glyphicon-log-in' ></span > Sair</a ></li >
            </ul >
        </div >
    </nav >
    <!--Fim Cabeçalho-->";
}

function menuLateral()
{
    echo"
        <!--Menu Lateral-->
        <div id = 'menuLateral' class='col-sm-2 sidenav' >
            <p ><a class='btn btn-info' href = '#' > Opção 1 </a ></p >
            <p ><a class='btn btn-info' href = '#' > Opção 2 </a ></p >
            <p ><a class='btn btn-info' href = '#' > Opção 3 </a ></p >
        </div >
        <!--Fim Menu Lateral-->";
}

function menuLateralAdmin()
{
    echo"
        <!--Menu Lateral-->
        <div id = 'menuLateral' class='col-sm-2 sidenav' >
            <ul class='nav navbar-nav'>
                    <li class='dropdown'>
                        <a id='Categoria' class='dropdown-toggle btn btn-info' data-toggle='dropdown' href='#'>Produto</a>
                        <ul id='SubMenu' class='dropdown-menu'>
                            <li class='dropdown-header'>PRODUTO</li>
                            <li><a href='../view/cadastroProduto.view.php'><span class='glyphicon glyphicon-chevron-right'></span> Cadastrar Produto</a></li>
                            <li><a href='../view/produtoExibirAdmin.view.php'><span class='glyphicon glyphicon-chevron-right'></span> Listar Produtos</a></li>
                            <li class='divider'></li>                            
                        </ul>
                    </li>
                    </ul>
        </div >
        <!--Fim Menu Lateral-->";
}

function rodape()
{
    echo"
    <!--Rodapé-->
    <div id='divRodapeContainer' class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <footer id = 'rodape' class='container-fluid text-center footer' >
                    <p > Desenvolvido por :</p >
                    <p > Iran Junior & Marcos Vinícius </p >
                    <p > Instituto Vianna Júnior - 2018 </p >
                </footer >
            </div>
        </div>
    </div>
    
    <!--Fim MRodapé-->";
}

function rodapePagPequena()
{
    echo"
    <!--Rodapé-->
    <footer id = 'rodapePeq' class='container-fluid text-center footer navbar-fixed-bottom' >
        <p > Desenvolvido por :</p >
        <p > Iran Junior & Marcos Vinícius </p >
        <p > Instituto Vianna Júnior - 2018 </p >
    </footer >
    <!--Fim MRodapé-->";
}


