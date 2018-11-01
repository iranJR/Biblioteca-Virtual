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

function rodape()
{
    echo"
    <!--Rodapé-->
    <footer id = 'rodape' class='container-fluid text-center footer navbar-fixed-bottom' >
        <p > Desenvolvido por :</p >
        <p > Iran Junior & Marcos Vinícius </p >
        <p > Instituto Vianna Júnior - 2018 </p >
    </footer >
    <!--Fim MRodapé-->";
}


