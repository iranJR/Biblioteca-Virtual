<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 11:13
 */

class Reserva
{
    private $idReserva;
    private $dataReserva;
    private $idUsuario;
    private $idLivro;

    /**
     * Reserva constructor.
     * @param $idReserva
     * @param $dataReserva
     * @param $idUsuario
     * @param $idLivro
     */
    public function __construct($idReserva, $dataReserva, $idUsuario, $idLivro)
    {
        $this->idReserva = $idReserva;
        $this->dataReserva = $dataReserva;
        $this->idUsuario = $idUsuario;
        $this->idLivro = $idLivro;
    }

    /**
     * @return mixed
     */
    public function getIdReserva()
    {
        return $this->idReserva;
    }

    /**
     * @param mixed $idReserva
     */
    public function setIdReserva($idReserva)
    {
        $this->idReserva = $idReserva;
    }

    /**
     * @return mixed
     */
    public function getDataReserva()
    {
        return $this->dataReserva;
    }

    /**
     * @param mixed $dataReserva
     */
    public function setDataReserva($dataReserva)
    {
        $this->dataReserva = $dataReserva;
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


}