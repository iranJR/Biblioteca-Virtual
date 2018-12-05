<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 04/12/2018
 * Time: 11:08
 */

session_start();

$_SESSION['idUsuario'] = null;
$_SESSION['tipoUsuario'] = null;
$_SESSION['nomeUsuario'] = null;

session_destroy();

echo "<script>window.location.href='../view/login.view.php'</script>";

?>