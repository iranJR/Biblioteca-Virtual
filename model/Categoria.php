<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 11:19
 */

class Categoria
{
    private $idCategoria;
    private $nome;
    private $descricaoCategoria;
    private $assunto;

    /**
     * Categoria constructor.
     * @param $idCategoria
     * @param $nome
     * @param $descricaoCategoria
     * @param $assunto
     */
    public function __construct($idCategoria, $nome, $descricaoCategoria, $assunto)
    {
        $this->idCategoria = $idCategoria;
        $this->nome = $nome;
        $this->descricaoCategoria = $descricaoCategoria;
        $this->assunto = $assunto;
    }

    /**
     * @return mixed
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * @param mixed $idCategoria
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
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
    public function getDescricaoCategoria()
    {
        return $this->descricaoCategoria;
    }

    /**
     * @param mixed $descricaoCategoria
     */
    public function setDescricaoCategoria($descricaoCategoria)
    {
        $this->descricaoCategoria = $descricaoCategoria;
    }

    /**
     * @return mixed
     */
    public function getAssunto()
    {
        return $this->assunto;
    }

    /**
     * @param mixed $assunto
     */
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
    }



}