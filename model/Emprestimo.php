<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 11:22
 */

class Emprestimo
{
    private $idEmprestimo;
    private $dataEmprestimo;
    private $dataDevolucao;
    private $idExemplar;
    private $idUsuario;
    private $situacao;

    /**
     * Emprestimo constructor.
     * @param $idEmprestimo
     * @param $dataEmprestimo
     * @param $dataDevolucao
     * @param $idExemplar
     * @param $idUsuario
     * @param $situacao
     */
    public function __construct($idEmprestimo, $dataEmprestimo, $dataDevolucao, $idExemplar, $idUsuario, $situacao)
    {
        $this->idEmprestimo = $idEmprestimo;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;
        $this->idExemplar = $idExemplar;
        $this->idUsuario = $idUsuario;
        $this->situacao = $situacao;
    }

    /**
     * @return mixed
     */
    public function getIdEmprestimo()
    {
        return $this->idEmprestimo;
    }

    /**
     * @param mixed $idEmprestimo
     */
    public function setIdEmprestimo($idEmprestimo)
    {
        $this->idEmprestimo = $idEmprestimo;
    }

    /**
     * @return mixed
     */
    public function getDataEmprestimo()
    {
        return $this->dataEmprestimo;
    }

    /**
     * @param mixed $dataEmprestimo
     */
    public function setDataEmprestimo($dataEmprestimo)
    {
        $this->dataEmprestimo = $dataEmprestimo;
    }

    /**
     * @return mixed
     */
    public function getDataDevolucao()
    {
        return $this->dataDevolucao;
    }

    /**
     * @param mixed $dataDevolucao
     */
    public function setDataDevolucao($dataDevolucao)
    {
        $this->dataDevolucao = $dataDevolucao;
    }

    /**
     * @return mixed
     */
    public function getIdExemplar()
    {
        return $this->idExemplar;
    }

    /**
     * @param mixed $idExemplar
     */
    public function setIdExemplar($idExemplar)
    {
        $this->idExemplar = $idExemplar;
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
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * @param mixed $situacao
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }



}