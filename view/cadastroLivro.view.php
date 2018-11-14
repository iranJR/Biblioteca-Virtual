<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 10/11/2018
 * Time: 18:50
 */

require_once ("../view/templateIndex.php");
require_once ("../model/Categoria.php");
require_once ("../dao/categoriaDao.php");
require_once ("../model/Livro.php");
require_once ("../dao/livroDao.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$anoAtual = date("Y");

if(!empty($_GET['id'])){
    $id = $_GET['id'];

    $dao = new livroDao();
    $livro = new Livro('','','','','','','','','');
    $livro = $dao->buscarPeloId($id);
}else{
    $id = "";
    $livro = new Livro('','','','','','','','','');
}
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
    <title>WebBook - Cadastro</title>

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
        <div id="conteudoPrincipal" class="col-md-10 text-left">

            <!--Formulário de Cadastro-->
            <div id="DivCadastroRegistro" class="container col-md-12">
            <h2 id="h2CadastroRegistro">Cadastro de Livro</h2>
            <hr id="hrCadastroRegistro">
            <?php
                if(!empty($_GET['id'])) {
                    echo "<form method='post' action='../controller/Livro.action.php?act=updt' enctype='multipart/form-data'>";
                }else{
                    echo "<form method='post' action='../controller/Livro.action.php?act=save' enctype='multipart/form-data'>";
                }
            ?>
                <div id="fildsetCadastroRegistro">
                <fieldset>
                    <legend>Dados Gerais:</legend>
                    <p><?php if(isset($_GET['msg'])){
                        echo $_GET['msg'];
                        } ?></p>
                    <div class="form-row">
                        <input type='hidden' name='id' value='<?= $livro->getIdLivro() ?>'>
                        <div class="form-group col-md-6">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" name="titulo" placeholder="Digite aqui o título..." required value="<?= $livro->getTitulo() ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="isbn">ISBN:</label>
                            <input type="text" class="form-control" name="isbn" placeholder="Digite aqui o ISBN..." required value="<?= $livro->getISBN() ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="autores">Autores:</label>
                            <input type="text" class="form-control" name="autores" placeholder="Digite aqui os autores..." required value="<?= $livro->getAutores() ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edicao">Edição:</label>
                            <input type="text" class="form-control" name="edicao" placeholder="Digite aqui a edição..." required value="<?= $livro->getEdicao() ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ano">Ano:</label>
                            <input type="number" class="form-control" name="ano" placeholder="Digite aqui o ano..." max="<?= $anoAtual ?>" required value="<?= $livro->getAno() ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editora">Editora:</label>
                            <input type="text" class="form-control" name="editora" placeholder="Digite aqui a editora..." required value="<?= $livro->getEditora() ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="categoria">Categoria:</label>
                            <select class="form-control" id="categoria" name="categoria" required >
                                <?php
                                if(!empty($_GET['id'])){
                                    $daoCategoria = new categoriaDao();
                                    $categoria = $daoCategoria->buscarPeloId($livro->getIdLivro());
                                    echo "<option value='".$categoria->getIdCategoria()."' name='".$categoria->getIdCategoria()."'>".$categoria->getNome()."</option>";
                                }else{
                                    echo"<option disabled selected>Selecione uma categoria...</option>";
                                }
                                $daoCategoria = new categoriaDao();
                                $categoria = $daoCategoria->buscarTodos();
                                foreach ($categoria as $cat){
                                    if($cat->idCategoria != $livro->getIdCategoria()) {
                                        echo "<option value='$cat->idCategoria' name='$cat->nome'>$cat->nome</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="capa">Adicione uma foto de capa:</label>
                            <input type="file" name="capa"><br>
                        </div>
                    </div>
                </fieldset>
                </div>

                <hr id="hrCadastroRegistro">
                <div class="form-row">
                    <div class="form-group col-md-8">
                <?php
                    if(!empty($_GET['id'])){
                        echo"<input id='botaoCadastroRegistro' type='submit' class='btn btn-info' value='ALTERAR'>";
                    }
                    else{
                        echo"<input id='botaoCadastroRegistro' type='submit' class='btn btn-info' value='CADASTRAR'>";
                    }
                ?>
                    </div>
                </div>
            </form>

            <!--Fim Formulário de Cadastro-->
            </div>

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