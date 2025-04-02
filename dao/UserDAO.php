<?php

require_once("models/User.php");

require_once("db.php");
 
 
 // Estabelece conexão segura com o banco via PDO, ativando tratamento de erros e prevenindo SQL Injection.

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 
} catch (PDOException $e) { // Se a conexão falhar, exibe a mensagem de erro sem quebrar o código
    echo "Error: " . $e->getMessage();
}

class UserDao implements UserDAOInterface{

    private $conn;
    private $url;

    public function __construct(PDO $conn, $url){
        $this->conn = $conn;
        $this->url = $url;
    }

    public function buildUser ($data){

        $user = new User();

        $user->id = $data["id"];
        $user->name = $data["name"];
        $user->lastname = $data["lastname"];
        $user->email = $data["email"];
        $user->password = $data["password"];
        $user->image = $data["image"];
        $user->bio = $data["bio"];
        $user->token = $data["token"];

        return $user;

    }

    public function create(User $user, $authUser = false){

    }

    public function update(User $user){

    }

    public function verifyToken($protected = false){

    }

    public function setTokenToSession($token, $redirect = true){

    }

    public function authenticateUser($email, $password){

    }

    public function findByEmail($email){

         if($email != "") {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          
          return $user;

        } else {
          return false;
        }

      } else {
        return false;
        }

    }

    public function findById($id){

    }

    public function findByToken($token){

    }

    public function changePassword(User $user){

    }


}