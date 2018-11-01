<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 15:03
 */
require_once "../banco/conexao_bd.php";
require_once "../model/Livro.php";
require_once "../dao/genericsDao.php";

class livroDao implements genericsDao
{

    public function salvar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO livro (titulo, ISBN, autores, edicao, editora, ano, idCategoria, capa ) VALUES(:titulo, :ISBN, :autores, :edicao, :editora, :ano, :idCategoria, :capa)");
            $statement->bindValue(":titulo",$objeto->getTitulo());
            $statement->bindValue(":ISBN",$objeto->getISBN());
            $statement->bindValue(":autores",$objeto->getAutores());
            $statement->bindValue(":edicao",$objeto->getEdicao());
            $statement->bindValue(":editora",$objeto->getEditora());
            $statement->bindValue(":ano",$objeto->getAno());
            $statement->bindValue(":idCategoria",$objeto->getIdCategoria());
            $statement->bindValue(":capa",$objeto->getCapa());
            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Cadastro realizado com sucesso');</script>";
                }
                else{
                    return"<script>alert('Erro ao tentar salvar o cadastro');</script>";
                }
            }
            else{
                throw new PDOException("<script>alert('Erro ao tentar executar o codigo sql');</script>");

            }
        }
        catch (PDOException $erro){
            return "Erro".$erro->getMessage();
        }


    }
    public function alterar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("UPDATE livro SET titulo = :titulo , ISBN = :ISBN, autores = :autores, edicao = :edicao, editora = :editora, ano = :ano, idCategoria = :idCategoria, capa = :capa WHERE idLivro = :id");

            $statement->bindValue(":id",$objeto->getIdLivro());
            $statement->bindValue(":titulo",$objeto->getTitulo());
            $statement->bindValue(":ISBN",$objeto->getISBN());
            $statement->bindValue(":autores",$objeto->getAutores());
            $statement->bindValue(":edicao",$objeto->getEdicao());
            $statement->bindValue(":editora",$objeto->getEditora());
            $statement->bindValue(":ano",$objeto->getAno());
            $statement->bindValue(":idCategoria",$objeto->getIdCategoria());
            $statement->bindValue(":capa",$objeto->getCapa());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Cadastro alterado com sucesso');</script>";
                }
                else{
                    return"<script>alert('Erro ao tentar alterar o cadastro');</script>";
                }
            }
            else{
                throw new PDOException("<script>alert('Erro ao tentar executar o codigo sql');</script>");

            }
        }
        catch (PDOException $erro){
            return "Erro".$erro->getMessage();
        }
    }

    public function apagar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("DELETE FROM livro WHERE idLivro = :id");

            $statement->bindValue(":id",$objeto->getIdLivro());
            if($statement->execute()) {

                return "<script>alert('Cadastro excluido com sucesso');</script>";
            }
            else{
                throw new PDOException("<script>alert('Erro ao tentar executar o codigo sql');</script>");
            }

        }
        catch (PDOException $erro){
            return "Erro".$erro->getMessage();
        }
    }

    public function buscarPeloId($id)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM livro WHERE idLivro= :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);

                $objeto = new Livro();

                $objeto->setIdLivro($rs->idLivro);
                $objeto->setTitulo($rs->titulo);
                $objeto->setISBN($rs->ISBN);
                $objeto->setAutores($rs->autores);
                $objeto->setEdicao($rs->edicao);
                $objeto->setEditora($rs->editora);
                $objeto->setAno($rs->ano);
                $objeto->setIdCategoria($rs->idCategoria);
                $objeto->setCapa($rs->capa);

                return $objeto;
            }
            else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Ocorreu um erro: " . $erro->getMessage();
        }
    }

    public function buscarTodos()
    {
        global $pdo;

        try{
            $statement= $pdo->prepare("SELECT * FROM livro ");
            if($statement->execute()){

                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                return $result;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Ocorreu um erro: " . $erro->getMessage();

        }

    }
}