<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 16:02
 */
require_once "../banco/conexao_bd.php";
require_once "../model/Emprestimo.php";
require_once "../dao/genericsDao.php";

class emprestimoDao implements genericsDao
{

    public function salvar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO emprestimo (dataEmprestimo, dataDevolucao, idExemplar, idUsuario, situacao) VALUES(:dataEmprestimo, :dataDevolucao, :idExemplar, :idUsuario, :situacao)");
            $statement->bindValue(":dataEmprestimo",$objeto->getDataEmprestimo());
            $statement->bindValue(":dataDevolucao",$objeto->getDataDevolucao());
            $statement->bindValue(":idExemplar",$objeto->getIdExemplar());
            $statement->bindValue(":idUsuario",$objeto->getIdUsuario());
            $statement->bindValue(":situacao",$objeto->getSituacao());
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
            $statement = $pdo->prepare("UPDATE emprestimo SET dataEmprestimo = :dataEmprestimo, dataDevolucao = :dataDevolucao, idExemplar = :idExemplar, idUsuario = :idUsuario, situacao = :situacao WHERE idEmprestimo = :id");


            $statement->bindValue(":id",$objeto->getIdEmprestimo());
            $statement->bindValue(":dataEmprestimo",$objeto->getDataEmprestimo());
            $statement->bindValue(":dataDevolucao",$objeto->getDataDevolucao());
            $statement->bindValue(":idExemplar",$objeto->getIdExemplar());
            $statement->bindValue(":idUsuario",$objeto->getIdUsuario());
            $statement->bindValue(":situacao",$objeto->getSituacao());
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
            $statement = $pdo->prepare("DELETE FROM emprestimo WHERE idEmprestimo = :id");

            $statement->bindValue(":id",$objeto->getIdEmprestimo());
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
            $statement = $pdo->prepare("SELECT * FROM emprestimo WHERE idEmprestimo= :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);

                $objeto = new Emprestimo('','','','','','');

                $objeto->setIdEmprestimo($rs->idEmprestimo);
                $objeto->setDataEmprestimo($rs->dataEmprestimo);
                $objeto->setDataDevolucao($rs->dataDevolucao);
                $objeto->setIdExemplar($rs->idExemplar);
                $objeto->setIdUsuario($rs->idUsuario);
                $objeto->setSituacao($rs->situacao);

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
            $statement= $pdo->prepare("SELECT * FROM emprestimo ");
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