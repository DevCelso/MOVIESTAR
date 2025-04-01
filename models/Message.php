<?php

class Message {

    private $url;

    public function __construct($url){
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Inicia a sessão apenas se não estiver ativa
        }
        $this->url = $url;
    }

    public function setMessage($msg, $type, $redirect = "index.php"){

        $_SESSION["msg"] = $msg;
        $_SESSION["type"] = $type;

        if($redirect != "back"){
            header("Location: " . rtrim($this->url, '/') . '/' . ltrim($redirect, '/'));
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }

        exit;
    }

    public function getMessage(){
        // Implementação futura
    }

    public function clearMessage(){
        // Implementação futura
    }

}
