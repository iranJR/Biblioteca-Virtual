<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 13:10
 */

require_once "../banco/conexao_bd.php";
require_once "../model/Usuario.php";
require_once "../dao/genericsDao.php";

class usuarioDao implements genericsDao
{

    public function salvar($objeto)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO usuario(nome, cpf, login, senha, idTipoUsuario) VALUES(:nome, :cpf, :login, :senha, :idTipoUsuario)");
            $statement->bindValue(":nome",$objeto->getNome());
            $statement->bindValue(":cpf",$objeto->getCpf());
            $statement->bindValue(":login",$objeto->getLogin());
            $statement->bindValue(":senha",$objeto->getSenha());
            $statement->bindValue(":idTipoUsuario",$objeto->getIdTipoUsuario());

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
            $statement = $pdo->prepare("UPDATE usuario SET nome=:nome, cpf=:cpf, login=:login, senha=:senha, idTipoUsuario=:idTipoUsuario WHERE idUsuario = :id");
            $statement->bindValue(":id",$objeto->getIdUsuario());
            $statement->bindValue(":nome",$objeto->getNome());
            $statement->bindValue(":cpf",$objeto->getCpf());
            $statement->bindValue(":login",$objeto->getLogin());
            $statement->bindValue(":senha",$objeto->getSenha());
            $statement->bindValue(":idTipoUsuario",$objeto->getIdTipoUsuario());


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
            $statement = $pdo->prepare("DELETE FROM usuario WHERE idUsuario = :id");

            $statement->bindValue(":id",$objeto->getIdUsuario());
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
            $statement = $pdo->prepare("SELECT * FROM usuario WHERE idUsuario= :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);

                $objeto = new Usuario('','','','','','');

                $objeto->setIdUsuario($rs->idUsuario);
                $objeto->setNome($rs->nome);
                $objeto->setCpf($rs->cpf);
                $objeto->setLogin($rs->login);
                $objeto->setSenha($rs->senha);
                $objeto->setIdTipoUsuario($rs->idTipoUsuario);

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
            $statement= $pdo->prepare("SELECT * FROM usuario ");
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

    public function buscarPeloLogin($login,$senha){
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM usuario WHERE login = :login AND senha = :senha");
            $statement->bindValue(":login",$login);
            $statement->bindValue(":senha",$senha);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);

                $objeto = new Usuario('','','','','','');

                $objeto->setIdUsuario($rs->idUsuario);
                $objeto->setNome($rs->nome);
                $objeto->setCpf($rs->cpf);
                $objeto->setLogin($rs->login);
                $objeto->setSenha($rs->senha);
                $objeto->setIdTipoUsuario($rs->idTipoUsuario);

                return $objeto;
            }
            else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Ocorreu um erro: " . $erro->getMessage();
        }

    }

    public function buscarByLogin($login){
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM usuario WHERE login = :login");
            $statement->bindValue(":login",$login);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);

                $objeto = new Usuario('','','','','','');

                $objeto->setIdUsuario($rs->idUsuario);
                $objeto->setNome($rs->nome);
                $objeto->setCpf($rs->cpf);
                $objeto->setLogin($rs->login);
                $objeto->setSenha($rs->senha);
                $objeto->setIdTipoUsuario($rs->idTipoUsuario);

                return $objeto;
            }
            else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Ocorreu um erro: " . $erro->getMessage();
        }

    }

}