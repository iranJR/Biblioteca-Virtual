<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 11:02
 */

class TipoUsuario
{
    private $idTipoUsuario;
    private $descricao;

    /**
     * TipoUsuario constructor.
     * @param $idTipoUsuario
     * @param $descricao
     */
    public function __construct($idTipoUsuario, $descricao)
    {
        $this->idTipoUsuario = $idTipoUsuario;
        $this->descricao = $descricao;
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

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }



}