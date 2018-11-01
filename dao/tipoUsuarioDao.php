<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 11:59
 */

require_once "../banco/conexao_bd.php";
require_once "../model/TipoUsuario.php";
require_once "../dao/genericsDao.php";

class tipoUsuarioDao implements genericsDao
{

    public function salvar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO tipousuario(descricao) VALUES (:descricao)");
            $statement->bindValue(":descricao",$objeto->getDescricao());
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
            $statement = $pdo->prepare("UPDATE tipousuario SET descricao = :descricao WHERE idTipoUsuario = :id");

            $statement->bindValue(":descricao",$objeto->getDescricao());
            $statement->bindValue(":id",$objeto->getIdTipoUsuario());
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
            $statement = $pdo->prepare("DELETE FROM tipousuario WHERE idTipoUsuario = :id");

            $statement->bindValue(":id",$objeto->getIdTipoUsuario());
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
           $statement = $pdo->prepare("SELECT * FROM tipousuario WHERE idTipoUsuario= :id");
           $statement->bindValue(":id",$id);
           if($statement->execute()){
               $rs= $statement->fetch(PDO::FETCH_OBJ);

               $objeto = new TipoUsuario();

               $objeto->setIdTipoUsuario($rs->idTipoUsuario);
               $objeto->setDescricao($rs->descricao);

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
          $statement= $pdo->prepare("SELECT * FROM tipousuario ");
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