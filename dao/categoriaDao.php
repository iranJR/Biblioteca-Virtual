<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 15:41
 */
require_once "../banco/conexao_bd.php";
require_once "../model/Categoria.php";
require_once "../dao/genericsDao.php";


class categoriaDao implements genericsDao
{

    public function salvar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO categoria (nome, descricao, assunto) VALUES(:nome, :descricaoCategoria, :assunto)");
            $statement->bindValue(":nome",$objeto->getNome());
            $statement->bindValue(":descricaoCategoria",$objeto->getDescricaoCategoria());
            $statement->bindValue(":assunto",$objeto->getAssunto());
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
            $statement = $pdo->prepare("UPDATE categoria SET nome = :nome, descricao = :descricaoCategoria, assunto = :assunto WHERE idCategoria = :id");

            $statement->bindValue(":id",$objeto->getIdCategoria());
            $statement->bindValue(":nome",$objeto->getNome());
            $statement->bindValue(":descricaoCategoria",$objeto->getDescricaoCategoria());
            $statement->bindValue(":assunto",$objeto->getAssunto());
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
            $statement = $pdo->prepare("DELETE FROM categoria WHERE idCategoria = :id");

            $statement->bindValue(":id",$objeto->getIdCategoria());
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
            $statement = $pdo->prepare("SELECT * FROM categoria WHERE idCategoria = :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);

                $objeto = new Categoria('','','','');

                $objeto->setIdCategoria($rs->idCategoria);
                $objeto->setNome($rs->nome);
                $objeto->setDescricaoCategoria($rs->descricao);
                $objeto->setAssunto($rs->assunto);

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
            $statement= $pdo->prepare("SELECT * FROM categoria ");
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