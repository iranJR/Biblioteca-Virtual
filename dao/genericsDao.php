<?php
/**
 * Created by PhpStorm.
 * User: matia
 * Date: 30/10/2018
 * Time: 12:14
 */

interface genericsDao
{
    public function salvar($objeto);
    public function alterar($objeto);
    public function apagar($objeto);
    public function buscarPeloId($id);
    public function buscarTodos();
}