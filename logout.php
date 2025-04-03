<?php
require_once("templates/header.php");
require_once("db.php"); 
require_once("dao/UserDAO.php");

// Criando a instância de UserDao corretamente
$userDao = new UserDAO($conn, $BASE_URL);

if ($userDao) {
    $userDao->destroyToken();
}

// Redireciona para a página inicial após o logout
header("Location: " . $BASE_URL . "index.php");
exit;
?>
