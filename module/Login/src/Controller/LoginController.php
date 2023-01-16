<?php

declare(strict_types=1);

namespace Login\Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Laminas\Authentication\AuthenticationService;
use Laminas\Code\Generator\DocBlock\Tag\AuthorTag;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\ViewModel;
use Login\Service\AuthService;

class LoginController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $this->layout()->setTemplate('login/login/index');

        return parent::onDispatch($e);
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function authAction()
    {
        $ds_login = $this->params()->fromQuery('ds_login');
        $ds_senha = $this->params()->fromQuery('ds_senha');
        
        $objAuthService = $this->getObjAuthService();

        $is_auth = $objAuthService->authenticate($ds_login, $ds_senha);
        
        if(!$is_auth){
            return $this->redirect()->toRoute('login');
        };

        $user = $objAuthService->findByCredentials($ds_login, $ds_senha);

        $jwtToken = $objAuthService->gerarJwt($user['cd_pessoa'], $user['ds_login']);

        setcookie('jwt_token', $jwtToken);

        return $this->redirect()->toRoute('welcome');
    }

    public function welcomeAction()
    {
        $this->layout()->setTemplate('login/login/welcome');

        if($this->validaAutorizacaoPorToken() == false) {
            return $this->redirect()->toRoute('login');
        }

        return new ViewModel();
    }

    public function logoutAction()
    {
        setcookie('jwt_token', '');

        return $this->redirect()->toRoute('login');
    }

    public function validaAutorizacaoPorToken()
    {
        $token = $this->findJwtToken();
        $tokenAlgorithm = $this->getObjAuthService()->getTokenAlgorithm();
        $cypherKey = $this->getObjAuthService()->getCypherKey();

        if(empty($token)) {
            return false;
        }

        JWT::decode($token, $tokenAlgorithm, [$cypherKey]);

        return true;
    }

    public function findJwtToken(): string
    {
        $request = $this->getRequest();
        
        $jwtToken = $request->getCookie('Authorization')->jwt_token;

        if(empty($jwtToken)) {
            return $jwtToken = '';
        }

        return $jwtToken;
    }
    
    public function getObjAuthService()
    {
        return $this->getEvent()
            ->getApplication()
            ->getServiceManager()
            ->get(AuthService::class);
    }
}
