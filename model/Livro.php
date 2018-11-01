<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 11:16
 */

class Livro
{
 private $idLivro;
 private $titulo;
 private $ISBN;
 private $autores;
 private $edicao;
 private $editora;
 private $ano;
 private $IdCategoria;
 private $capa;

    /**
     * Livro constructor.
     * @param $idLivro
     * @param $titulo
     * @param $ISBN
     * @param $autores
     * @param $edicao
     * @param $editora
     * @param $ano
     * @param $IdCategoria
     * @param $capa
     */
    public function __construct($idLivro, $titulo, $ISBN, $autores, $edicao, $editora, $ano, $IdCategoria, $capa)
    {
        $this->idLivro = $idLivro;
        $this->titulo = $titulo;
        $this->ISBN = $ISBN;
        $this->autores = $autores;
        $this->edicao = $edicao;
        $this->editora = $editora;
        $this->ano = $ano;
        $this->IdCategoria = $IdCategoria;
        $this->capa = $capa;
    }

    /**
     * @return mixed
     */
    public function getIdLivro()
    {
        return $this->idLivro;
    }

    /**
     * @param mixed $idLivro
     */
    public function setIdLivro($idLivro)
    {
        $this->idLivro = $idLivro;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getISBN()
    {
        return $this->ISBN;
    }

    /**
     * @param mixed $ISBN
     */
    public function setISBN($ISBN)
    {
        $this->ISBN = $ISBN;
    }

    /**
     * @return mixed
     */
    public function getAutores()
    {
        return $this->autores;
    }

    /**
     * @param mixed $autores
     */
    public function setAutores($autores)
    {
        $this->autores = $autores;
    }

    /**
     * @return mixed
     */
    public function getEdicao()
    {
        return $this->edicao;
    }

    /**
     * @param mixed $edicao
     */
    public function setEdicao($edicao)
    {
        $this->edicao = $edicao;
    }

    /**
     * @return mixed
     */
    public function getEditora()
    {
        return $this->editora;
    }

    /**
     * @param mixed $editora
     */
    public function setEditora($editora)
    {
        $this->editora = $editora;
    }

    /**
     * @return mixed
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * @param mixed $ano
     */
    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    /**
     * @return mixed
     */
    public function getIdCategoria()
    {
        return $this->IdCategoria;
    }

    /**
     * @param mixed $IdCategoria
     */
    public function setIdCategoria($IdCategoria)
    {
        $this->IdCategoria = $IdCategoria;
    }

    /**
     * @return mixed
     */
    public function getCapa()
    {
        return $this->capa;
    }

    /**
     * @param mixed $capa
     */
    public function setCapa($capa)
    {
        $this->capa = $capa;
    }


}