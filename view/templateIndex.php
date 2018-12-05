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
                <a id = 'linkLogo' href = '../view/index.php' >
                    <img id = 'imgLogo' src = '../imagens/logoSite.png' >
    WebBook</a >
            </div >
            <ul id = 'iconesCabecalho' class='nav navbar-nav navbar-right' >
                <li ><a href = '#' ><span class='glyphicon glyphicon-user' ></span > Olá, ".$_SESSION['nomeUsuario']."</a ></li >
                <li ><a href = '../controller/Logout.action.php' ><span class='glyphicon glyphicon-log-in' ></span > Sair</a ></li >
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
                <p ><a class='btn btn-info' href = '../view/index.php' > Home </a ></p >
                <p ><a class='btn btn-info' href = '../view/consultaAcervo.view.php' > Consultar Acervo </a ></p >
                <p ><a class='btn btn-info' href = '../view/cadastroCategoria.view.php' > Cadastrar Categoria </a ></p >
                <p ><a class='btn btn-info' href = '../view/exibirCategoria.view.php' > Exibir Categorias </a ></p >
                <p ><a class='btn btn-info' href = '../view/cadastroLivro.view.php' > Cadastrar Livro </a ></p >
                <p ><a class='btn btn-info' href = '../view/exibirLivro.view.php' > Exibir Livros </a ></p >
                <p ><a class='btn btn-info' href = '../view/exibirLivroExemplar.view.php' > Listar Exemplares </a ></p >
                <p ><a class='btn btn-info' href = '../view/cadastroUsuario.view.php' > Cadastrar Usuário </a ></p >
                <p ><a class='btn btn-info' href = '../view/exibirEmprestimos.view.php' > Consultar Emprestimos </a ></p >
                <p ><a class='btn btn-info' href = '../controller/Logout.action.php' > Sair </a ></p >
        </div >
        <!--Fim Menu Lateral-->";
}

function menuLateralUsuario()
{
    echo"
        <!--Menu Lateral-->
            <div id = 'menuLateral' class='col-sm-2 sidenav' >
                <p ><a class='btn btn-info' href = '../view/index.php' > Home </a ></p >
                <p ><a class='btn btn-info' href = '../view/consultaAcervo.view.php' > Consultar Acervo </a ></p >
                <p ><a class='btn btn-info' href = '../view/meusEmprestimos.php' > Meus Emprestimos </a ></p >
                <p ><a class='btn btn-info' href = '../controller/Logout.action.php' > Sair </a ></p >
            </div >
        <!--Fim Menu Lateral-->";
}

function menuLateralBibliotecario(){
    echo"
        <!--Menu Lateral-->
        <div id = 'menuLateral' class='col-sm-2 sidenav' >
            <p ><a class='btn btn-info' href = '../view/index.php' > Home </a ></p >
            <p ><a class='btn btn-info' href = '../view/cadastroCategoria.view.php' > Cadastrar Categoria </a ></p >
            <p ><a class='btn btn-info' href = '../view/exibirCategoria.view.php' > Exibir Categorias </a ></p >
            <p ><a class='btn btn-info' href = '../view/cadastroLivro.view.php' > Cadastrar Livro </a ></p >
            <p ><a class='btn btn-info' href = '../view/exibirLivro.view.php' > Exibir Livros </a ></p >
            <p ><a class='btn btn-info' href = '../view/exibirLivroExemplar.view.php' > Listar Exemplares </a ></p >
            <p ><a class='btn btn-info' href = '../controller/Logout.action.php' > Sair </a ></p >
        </div >
        <!--Fim Menu Lateral-->";
}

function menuLateralFuncionario()
{
    echo"
        <!--Menu Lateral-->
        <div id = 'menuLateral' class='col-sm-2 sidenav' >
            <p ><a class='btn btn-info' href = '../view/index.php' > Home </a ></p >
            <p ><a class='btn btn-info' href = '../view/cadastroUsuario.view.php' > Cadastrar Usuário </a ></p >
            <p ><a class='btn btn-info' href = '../view/consultaAcervo.view.php' > Consultar Acervo </a ></p >
            <p ><a class='btn btn-info' href = '../view/exibirEmprestimos.view.php' > Consultar Emprestimos </a ></p >
            <p ><a class='btn btn-info' href = '../controller/Logout.action.php' > Sair </a ></p >
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


