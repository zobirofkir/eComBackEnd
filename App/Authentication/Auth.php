<?php
namespace Auth;

use config\Config;
use config\Connection;
use Firebase\JWT\JWT;
use Exception;

class Auth
{
    private $username;
    private $email;
    private $password;
    private $payloadAuth;

    private $db;
    private $secretKey = 'your_secret_key'; // Change this to your secret key

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
        $this->payloadAuth = new Config();
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


    public function register()
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            return false;
        }

        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user && password_verify($this->password, $user['password'])) {
            $config = new Config();
            $payload = $config->payload($user);
            $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

            return [$jwt];
        } else {
            return false;
        }
    }

    public function logout()
    {
        return true;
    }
}
