<?php
namespace Middleware;

use Auth\Auth;

class Middleware extends Auth
{
    public function getBearerToken()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { // Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in apache_request_headers() function
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public function authenticated ()
    {
        $token = $this->getBearerToken();
        if ($token) {
            $decodedToken = $this->verifyToken($token);
            if ($decodedToken) {
                return $decodedToken;
            }
        }
        http_response_code(401); // Unauthorized
        echo json_encode(["status" => false, "message" => "Unauthorized"]);
        exit();
    }
}