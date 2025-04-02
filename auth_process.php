<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);




//resgata o tipo de form
$type = filter_input(INPUT_POST, "type");

//verificação do tipo de form

if($type === "register"){

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    //Verificação de dados mínimos
    if($name && $lastname && $email && $password){

        //Verificar se as senhas batem
        if($password === $confirmpassword){
            

            //verificar se o e-mail já está cadastrado
            if($userDao->findByEmail($email) === false){

               echo"sem user encontrado";

            } else {

            //Enviar msg de erro de usuario existente
            $message->setMessage("Usuário já cadastrado, tente outro e-mail!", "error", "back");

            }

        } else {

            //Enviar msg de erro de senhas diferentes
            $message->setMessage("As senhas não são iguais!", "error", "back");
        }

    } else{

        //Enviar uma msg de erro, de dados faltantes
        $message->setMessage("Por favor, preencha todos os campos.", "error", "back");

    }

} else if($type === "login"){



}
