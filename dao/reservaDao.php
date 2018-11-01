<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 14:43
 */

require_once "../banco/conexao_bd.php";
require_once "../model/Reserva.php";
require_once "../dao/genericsDao.php";

class reservaDao implements genericsDao
{

    public function salvar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO reserva (dataReserva, idUsuario, idLivro) VALUES (:dataReserva, :idUsuario, :idLivro)");
            $statement->bindValue(":dataReserva",$objeto->getDataRserva());
            $statement->bindValue(":idUsuario",$objeto->getIdUsuario());
            $statement->bindValue(":idLivro",$objeto->getIdLivro());
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
            $statement = $pdo->prepare("UPDATE reserva SET dataReserva = :dataReserva, idUsuario = :idUsuario, idLivro = :idLivro WHERE idReserva = :id");

            $statement->bindValue(":id",$objeto->getIdReserva());
            $statement->bindValue(":dataReserva",$objeto->getDataReserva());
            $statement->bindValue(":idUsuario",$objeto->getIdUsuario());
            $statement->bindValue(":idLivro",$objeto->getIdLivro());
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
            $statement = $pdo->prepare("DELETE FROM reserva WHERE idReserva = :id");

            $statement->bindValue(":id",$objeto->getIdReserva());
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
            $statement = $pdo->prepare("SELECT * FROM reserva WHERE idReserva = :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);

                $objeto = new Reserva();

                $objeto->setIdReserva($rs->idReserva);
                $objeto->setDataReserva($rs->dataReserva);
                $objeto->setIdUsuario($rs->idUsuario);
                $objeto->setIdLivro($rs->idLivro);

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
            $statement= $pdo->prepare("SELECT * FROM reserva ");
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