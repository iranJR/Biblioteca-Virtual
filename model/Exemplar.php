<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 16:55
 */

class Exemplar
{
   private $idExemplar;
   private $idLivro;
   private $circular;
   private $tipo;
   private $arquivoDigital;
   private $status;

    /**
     * Exemplar constructor.
     * @param $idExemplar
     * @param $idLivro
     * @param $circular
     * @param $tipo
     * @param $arquivoDigital
     * @param $status
     */
    public function __construct($idExemplar, $idLivro, $circular, $tipo, $arquivoDigital, $status)
    {
        $this->idExemplar = $idExemplar;
        $this->idLivro = $idLivro;
        $this->circular = $circular;
        $this->tipo = $tipo;
        $this->arquivoDigital = $arquivoDigital;
        $this->status = $status;
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
    public function getCircular()
    {
        return $this->circular;
    }

    /**
     * @param mixed $circular
     */
    public function setCircular($circular)
    {
        $this->circular = $circular;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getArquivoDigital()
    {
        return $this->arquivoDigital;
    }

    /**
     * @param mixed $arquivoDigital
     */
    public function setArquivoDigital($arquivoDigital)
    {
        $this->arquivoDigital = $arquivoDigital;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


}