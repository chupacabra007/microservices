<?php

namespace users\Infrastructure\Service;

use \Firebase\JWT\JWT;

class JWTService {
    private $privateKey;
    
    public function __construct($privateKey){
        $this->privateKey = $privateKey;    
    }
    
    public function getToken($user){
        $issuedAt = time();        
        $payload = [
            'iss' => 'users',
            'nbf' => $issuedAt,
            'iat' => $issuedAt,
            'sub' => $user,
            'jti' => base64_encode(random_bytes(32))
        ]; 
        return JWT::encode($payload, $this->privateKey, 'RS256');
    }
}