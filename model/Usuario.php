<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 11:08
 */

class Usuario
{
    private $idUsuario;
    private $nome;
    private $cpf;
    private $login;
    private $senha;
    private $idTipoUsuario;

    /**
     * Usuario constructor.
     * @param $idUsuario
     * @param $nome
     * @param $cpf
     * @param $login
     * @param $senha
     * @param $idTipoUsuario
     */
    public function __construct($idUsuario, $nome, $cpf, $login, $senha, $idTipoUsuario)
    {
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->login = $login;
        $this->senha = $senha;
        $this->idTipoUsuario = $idTipoUsuario;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }

    /**
     * @param mixed $idTipoUsuario
     */
    public function setIdTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;
    }


}