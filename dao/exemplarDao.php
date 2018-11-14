<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 01/11/2018
 * Time: 15:40
 */
require_once "../banco/conexao_bd.php";
require_once "../model/Exemplar.php";
require_once "../dao/genericsDao.php";

class exemplarDao implements genericsDao
{

    public function salvar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO exemplar (idLivro, circular, tipo, arquivoDigital, status) VALUES(:idLivro, :circular, :tipo, :arquivoDigital, :status)");
            $statement->bindValue(":idLivro",$objeto->getIdLivro());
            $statement->bindValue(":circular",$objeto->getCircular());
            $statement->bindValue(":tipo",$objeto->getTipo());
            $statement->bindValue(":arquivoDigital",$objeto->getArquivoDigital());
            $statement->bindValue(":status",$objeto->getStatus());

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
            $statement = $pdo->prepare("UPDATE exemplar SET idLivro = :idLivro, circular = :circular, tipo = :tipo, arquivoDigital = :arquivoDigital, status = :status WHERE idExemplar = :id ");
            $statement->bindValue(":idLivro",$objeto->getIdLivro());
            $statement->bindValue(":circular",$objeto->getCircular());
            $statement->bindValue(":tipo",$objeto->getTipo());
            $statement->bindValue(":arquivoDigital",$objeto->getArquivoDigital());
            $statement->bindValue(":status",$objeto->getStatus());
            $statement->bindValue(":id",$objeto->getIdExemplar());

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

    public function apagar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("DELETE FROM exemplar WHERE idExemplar = :id");

            $statement->bindValue(":id",$objeto->getIdExemplar());
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
            $statement = $pdo->prepare("SELECT * FROM exemplar WHERE idExemplar = :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);

                $objeto = new Exemplar('','','','','','');

                $objeto->setIdExemplar($rs->idExemplar);
                $objeto->setIdLivro($rs->idLivro);
                $objeto->setCircular($rs->circular);
                $objeto->setTipo($rs->tipo);
                $objeto->setArquivoDigital($rs->arquivoDigital);
                $objeto->setStatus($rs->status);

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
            $statement= $pdo->prepare("SELECT * FROM exemplar ");
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