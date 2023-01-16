<?php 

namespace Login\Service;

use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Login\Repository\PessoaRepository;

class AuthService
{
    private $objPessoaRepository;
    private $cypherKey = 'chave-teste';
    private $tokenAlgorithm = 'HS256';
    private $jwtToken;

    public function __construct(PessoaRepository $objPessoaRepository)
    {
        $this->setObjPessoaRepository($objPessoaRepository);
    }

    public function gerarJwt(
        $cd_pessoa,
        $ds_login
    ) : string
    {
        $customPayload = [
            'sub' => $cd_pessoa,
            'aud' => $ds_login
        ];

        $payload = array_merge(
            [
                'exp' => (new DateTime('now'))->modify('+24 hours')->getTimestamp(),
                'iat' => (new DateTime('now'))->getTimestamp(),
            ],
            $customPayload
        );

        $token = JWT::encode(
            $payload, 
            $this->getCypherKey(), 
            $this->getTokenAlgorithm()
        );
        
        return $token;
    }

    public function authenticate(
        string $ds_login,
        string $ds_senha
    )
    {
        $user = $this->findByCredentials($ds_login, $ds_senha);
        
        if (!$user || $user['ds_login'] != $ds_login && $user['ds_senha'] != $ds_senha) {
            return false;
        }

        return true;
    }

    public function findByCredentials($ds_login, $ds_senha)
    {
        return (array) $this->getObjPessoaRepository()->findByCredentials($ds_login, $ds_senha);
    }

    public function getCypherKey()
    {
        return $this->cypherKey;
    }

    public function setCypherKey($cypherKey)
    {
        $this->cypherKey = $cypherKey;

        return $this;
    }

    public function getTokenAlgorithm()
    {
        return $this->tokenAlgorithm;
    }

    public function setTokenAlgorithm($tokenAlgorithm)
    {
        $this->tokenAlgorithm = $tokenAlgorithm;

        return $this;
    }

    public function getJwtToken()
    {
        return $this->jwtToken;
    }

    public function setJwtToken($jwtToken)
    {
        $this->jwtToken = $jwtToken;

        return $this;
    }


    public function getObjPessoaRepository()
    {
        return $this->objPessoaRepository;
    }

    public function setObjPessoaRepository($objPessoaRepository)
    {
        $this->objPessoaRepository = $objPessoaRepository;

        return $this;
    }
}