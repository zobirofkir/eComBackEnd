<?php
namespace Auth;

use config\Config;
use config\Connection;
use Firebase\JWT\JWT;
use Exception;

class Auth extends Config
{
    protected $table = "users";
    
    protected $username;
    protected $email;
    protected $password;
    protected $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function setRegisterCredentials($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function setLoginCredentials($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authRegister()
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            return false;
        }

        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO $this->table (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return true;
        } 
        return false;
    }

    public function authLogin()
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE username = :username");
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user && password_verify($this->password, $user['password'])) {
            $config = new Config();
            $payload = $config->payload($user);
            $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

            return [$jwt];
        }
        return false;
    }

    public function authLogout()
    {
        return true;
    }
}