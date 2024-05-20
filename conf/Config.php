<?php
namespace config;

use Dotenv\Dotenv;

class Config 
{
    public function payload($user)
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        return [
            'iss' => $_ENV["ISS"],
            'aud' => $_ENV["AUD"],
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + (60 * 60), 
            'data' => [
                'id' => $user['id'],
                'username' => $user['username']
            ]
        ];
    }
}
